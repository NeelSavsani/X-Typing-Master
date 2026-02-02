<?php
include "dbconnect.php";

$enrollment = $_POST['enrollment'] ?? "";

/* Get Max Typing Score */
$maxRes = mysqli_query($conn, "SELECT MAX(typing_score) AS max_score FROM user");
$maxRow = mysqli_fetch_assoc($maxRes);
$maxTypingScore = $maxRow['max_score'] ?: 1; // avoid divide by zero

if ($enrollment === "") {
    $query = "SELECT * FROM user ORDER BY enrollment";
} else {
    $query = "SELECT * FROM user WHERE enrollment LIKE '%$enrollment%' ORDER BY enrollment";
}

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<tr><td colspan='9' style='color:red;'>No records found</td></tr>";
    exit;
}

while ($row = mysqli_fetch_assoc($result)) {

    $statusClass = strtolower($row['status']) === "approved"
        ? "status-approved"
        : "status-pending";

    /* Typing % */
    $typingPercent = round(
        100 * ($row['typing_score'] / $maxTypingScore),
        2
    );

    /* Quiz % (max = 16000) */
    $quizPercent = round(
        100 * ($row['quiz_score'] / 16000),
        2
    );

    /* Final Score (equal weight) */
    $finalScore = round(
        ($typingPercent + $quizPercent) / 2,
        2
    );

    echo "
    <tr>
        <td>{$row['enrollment']}</td>
        <td>{$row['name']}</td>
        <td>{$row['mobile']}</td>
        <td>{$row['email']}</td>
        <td class='{$statusClass}'>" . ucfirst($row['status']) . "</td>
        <td>{$typingPercent}%</td>
        <td>{$quizPercent}%</td>
        <td><strong>{$finalScore}%</strong></td>
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
