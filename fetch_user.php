<?php
include "dbconnect.php";

$enrollment = $_POST['enrollment'] ?? "";

/* Get Max Typing Score */
$maxResult = mysqli_query($conn, "SELECT MAX(typing_score) AS max_score FROM user");
$maxRow = mysqli_fetch_assoc($maxResult);
$maxTypingScore = $maxRow['max_score'] ?: 1; // avoid divide by zero

if ($enrollment === "") {
    $query = "SELECT * FROM user ORDER BY enrollment";
} else {
    $query = "SELECT * FROM user WHERE enrollment LIKE '%$enrollment%' ORDER BY enrollment";
}

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<tr><td colspan='8' style='color:red;'>No records found</td></tr>";
    exit;
}

while ($row = mysqli_fetch_assoc($result)) {

    $statusClass = strtolower($row['status']) === "approved"
        ? "status-approved"
        : "status-pending";

    /* Typing Percentage Formula */
    $typingPercentage = round(
        100 * ($row['typing_score'] / $maxTypingScore),
        2
    );

    echo "
    <tr>
        <td>{$row['enrollment']}</td>
        <td>{$row['name']}</td>
        <td>{$row['mobile']}</td>
        <td>{$row['email']}</td>
        <td class='{$statusClass}'>" . ucfirst($row['status']) . "</td>
        <td>{$typingPercentage}%</td>
        <td>{$row['quiz_score']}</td>
        <td>
            <button class='edit-btn'
                onclick=\"editRow(
                    '{$row['enrollment']}',
                    '{$row['wpm']}',
                    '{$row['accuracy']}',
                    '{$row['quiz_score']}'
                )\">
                Edit
            </button>
        </td>
    </tr>";
}
