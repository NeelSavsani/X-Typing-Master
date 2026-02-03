<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <ta charset="UTF-8">
    <title>Competition Dashboard</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="css/home.css">
</head>
<body>

<div class="box">
    <h2><i class="fa-solid fa-ranking-star"></i> Participant Scores</h2>

    <!-- ACTION BAR -->
    <div class="action-bar">
        <button class="btn-primary"
                onclick="window.location.href='leaderboard.php'">
            <i class="fa-solid fa-trophy"></i> Leaderboard
        </button>

        <button class="btn-secondary"
                onclick="window.location.href='export_csv.php'">
            <i class="fa-solid fa-file-export"></i> Export CSV
        </button>
    </div>

    <input
        type="text"
        id="enrollment"
        placeholder="Search by enrollment..."
        autocomplete="off"
    >
    <div class="table-wrapper">

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
</div>

<!-- EDIT MODAL -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h3><i class="fa-solid fa-pen-to-square"></i> Edit Scores</h3>

        <input type="hidden" id="editEnrollment">

        <label>WPM</label>
        <input type="number" id="editWpm" min="0">

        <label>Accuracy (%)</label>
        <input type="number" id="editAccuracy" min="0" max="100">

        <label>Quiz Score</label>
        <input type="number" id="editQuizScore" min="0" max="16000">

        <div class="modal-actions">
            <button class="btn-danger" onclick="cancelEdit()">
                <i class="fa-solid fa-xmark"></i> Cancel
            </button>

            <button class="btn-success" id="saveBtn" onclick="saveEdit()">
                <span><i class="fa-solid fa-floppy-disk"></i> Save</span>
            </button>
        </div>
    </div>
</div>

<div id="toast" class="toast"></div>

<script>
    function openEditModal() {
  document.getElementById("editModal").classList.add("show");
}
function closeEditModal() {
  document.getElementById("editModal").classList.remove("show");
}

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