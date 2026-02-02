<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>

<div class="box">
    <h2>Search by Enrollment</h2>

    <input type="text" id="enrollment"
           placeholder="Start typing enrollment number..."
           autocomplete="off">

    <h3 class="table-title">Users</h3>

    <table>
        <thead>
            <tr>
                <th>Enrollment</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>WPM</th>
                <th>Quiz</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="tableResult"></tbody>
    </table>
</div>

<!-- MODAL -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h3>Edit Scores</h3>

        <input type="hidden" id="editEnrollment">

        <label>WPM</label>
        <input type="number" id="editWpm" min="0">

        <label>Quiz</label>
        <input type="number" id="editQuiz" min="0">

        <div class="modal-actions">
            <button class="btn-cancel" onclick="cancelEdit()">Cancel</button>
            <button class="btn-save" id="saveBtn" onclick="saveEdit()">
                <span>Save</span>
            </button>
        </div>
    </div>
</div>

<div id="toast" class="toast"></div>

<script>
function loadData(enrollment = "") {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "fetch_user.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = () => document.getElementById("tableResult").innerHTML = xhr.responseText;
    xhr.send("enrollment=" + encodeURIComponent(enrollment));
}

window.onload = () => loadData();
document.getElementById("enrollment").addEventListener("keyup", e => loadData(e.target.value));

function editRow(enrollment, wpm, quiz) {
    editEnrollment.value = enrollment;
    editWpm.value = wpm;
    editQuiz.value = quiz;
    editModal.classList.add("show");
}

function closeModal() {
    editModal.classList.remove("show");
}

function cancelEdit() {
    closeModal();
    showToast("Edit cancelled", "cancel");
}

function saveEdit() {
    const saveBtn = document.getElementById("saveBtn");
    saveBtn.classList.add("loading");
    saveBtn.disabled = true;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "update_user.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        saveBtn.classList.remove("loading");
        saveBtn.disabled = false;

        if (this.responseText.trim() === "success") {
            closeModal();
            loadData(enrollment.value);
            showToast("Changes saved successfully", "success");
        } else {
            showToast("Failed to save changes", "error");
        }
    };

    xhr.onerror = function () {
        saveBtn.classList.remove("loading");
        saveBtn.disabled = false;
        showToast("Network error", "error");
    };

    xhr.send(
        "enrollment=" + encodeURIComponent(editEnrollment.value) +
        "&wpm=" + encodeURIComponent(editWpm.value) +
        "&quiz=" + encodeURIComponent(editQuiz.value)
    );
}

function showToast(msg, type) {
    toast.textContent = msg;
    toast.className = "toast show " + type;
    setTimeout(() => toast.className = "toast", 2500);
}

/* ESC + outside click */
document.addEventListener("keydown", e => e.key === "Escape" && closeModal());
editModal.addEventListener("click", e => e.target === editModal && closeModal());
</script>

</body>
</html>
