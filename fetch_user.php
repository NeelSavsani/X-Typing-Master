<?php
include "dbconnect.php";

$enrollment = $_POST['enrollment'] ?? "";

if ($enrollment === "") {
    $query = "SELECT enrollment, username, email, mobile, status, wpm, quiz
              FROM `user`
              ORDER BY enrollment";
} else {
    $query = "SELECT enrollment, username, email, mobile, status, wpm, quiz
              FROM `user`
              WHERE enrollment LIKE '%$enrollment%'
              ORDER BY enrollment";
}

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database error");
}

if (mysqli_num_rows($result) == 0) {
    echo "<tr>
            <td colspan='8' style='color:red;font-weight:bold;'>
                Enrollment not found
            </td>
          </tr>";
    exit;
}

while ($row = mysqli_fetch_assoc($result)) {

    $statusClass = (strtolower($row['status']) === "approved")
        ? "status-approved"
        : "status-pending";

    echo "
        <tr>
            <td>{$row['enrollment']}</td>
            <td>{$row['username']}</td>
            <td>{$row['email']}</td>
            <td>{$row['mobile']}</td>
            <td class='{$statusClass}'>" . ucfirst($row['status']) . "</td>
            <td>{$row['wpm']}</td>
            <td>{$row['quiz']}</td>
            <td>
                <button class='edit-btn'
                    onclick=\"editRow(
                        '{$row['enrollment']}',
                        '{$row['wpm']}',
                        '{$row['quiz']}'
                    )\">
                    Edit
                </button>
            </td>
        </tr>
    ";
}
