<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Competition Dashboard</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>

<div class="box">
    <h2>Participant Scores</h2>

    <!-- ACTION BAR -->
    <div style="display:flex; gap:10px; margin-bottom:15px;">
        <button class="btn-save" onclick="window.location.href='export_csv.php'">
            📤 Export CSV
        </button>
    </div>

    <input
        type="text"
        id="enrollment"
        placeholder="Search by enrollment..."
        autocomplete="off"
    >

    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Enrollment</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th>Typing %</th>
                <th>Quiz %</th>
                <th>Final Score</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tableResult"></tbody>
    </table>
</div>

<!-- EDIT MODAL -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h3>Edit Scores</h3>

        <input type="hidden" id="editEnrollment">

        <label>WPM</label>
        <input type="number" id="editWpm" min="0">

        <label>Accuracy (%)</label>
        <input type="number" id="editAccuracy" min="0" max="100">

        <label>Quiz Score</label>
        <input type="number" id="editQuizScore" min="0" max="16000">

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
function loadData(val = "") {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "fetch_user.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = () => tableResult.innerHTML = xhr.responseText;
    xhr.send("enrollment=" + encodeURIComponent(val));
}

window.onload = () => loadData();
enrollment.addEventListener("keyup", e => loadData(e.target.value));

function editRow(enrollment, wpm, accuracy, quizScore) {
    editEnrollment.value = enrollment;
    editWpm.value = wpm;
    editAccuracy.value = accuracy;
    editQuizScore.value = quizScore;
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
    const btn = document.getElementById("saveBtn");
    btn.classList.add("loading");
    btn.disabled = true;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "update_user.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        btn.classList.remove("loading");
        btn.disabled = false;

        if (this.responseText.trim() === "success") {
            closeModal();
            loadData(enrollment.value);
            showToast("Scores updated successfully", "success");
        } else {
            showToast("Update failed", "error");
        }
    };

    xhr.send(
        "enrollment=" + editEnrollment.value +
        "&wpm=" + editWpm.value +
        "&accuracy=" + editAccuracy.value +
        "&quiz_score=" + editQuizScore.value
    );
}

function showToast(msg, type) {
    toast.textContent = msg;
    toast.className = "toast show " + type;
    setTimeout(() => toast.className = "toast", 2500);
}

document.addEventListener("keydown", e => e.key === "Escape" && closeModal());
editModal.addEventListener("click", e => e.target === editModal && closeModal());
</script>

</body>
</html>
