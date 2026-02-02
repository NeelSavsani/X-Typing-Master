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

    <input
        type="text"
        id="enrollment"
        placeholder="Start typing enrollment number..."
        autocomplete="off"
    >

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
        <tbody id="tableResult">
            <!-- AJAX DATA -->
        </tbody>
    </table>
</div>

<!-- EDIT MODAL -->
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
            <button class="btn-save" onclick="saveEdit()">Save</button>
        </div>
    </div>
</div>

<!-- TOAST -->
<div id="toast" class="toast"></div>

<script>
/* Load table */
function loadData(enrollment = "") {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "fetch_user.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById("tableResult").innerHTML = this.responseText;
        }
    };

    xhr.send("enrollment=" + encodeURIComponent(enrollment));
}

window.onload = () => loadData();

document.getElementById("enrollment").addEventListener("keyup", function () {
    loadData(this.value);
});

/* Open modal */
function editRow(enrollment, wpm, quiz) {
    document.getElementById("editEnrollment").value = enrollment;
    document.getElementById("editWpm").value = wpm;
    document.getElementById("editQuiz").value = quiz;

    document.getElementById("editModal").classList.add("show");
}

/* Close modal */
function closeModal() {
    document.getElementById("editModal").classList.remove("show");
}

/* Cancel */
function cancelEdit() {
    closeModal();
    showToast("Edit cancelled", "cancel");
}

/* Save */
function saveEdit() {
    const enrollment = document.getElementById("editEnrollment").value;
    const wpm = document.getElementById("editWpm").value;
    const quiz = document.getElementById("editQuiz").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "update_user.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (this.status === 200 && this.responseText.trim() === "success") {
            closeModal();
            loadData(document.getElementById("enrollment").value);
            showToast("Changes saved successfully", "success");
        } else {
            showToast("Failed to save changes", "error");
        }
    };

    xhr.onerror = function () {
        showToast("Network error", "error");
    };

    xhr.send(
        "enrollment=" + encodeURIComponent(enrollment) +
        "&wpm=" + encodeURIComponent(wpm) +
        "&quiz=" + encodeURIComponent(quiz)
    );
}

/* Toast */
function showToast(message, type) {
    const toast = document.getElementById("toast");
    toast.textContent = message;
    toast.className = "toast show " + type;

    setTimeout(() => {
        toast.className = "toast";
    }, 2500);
}
</script>

</body>
</html>
