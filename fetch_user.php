<?php
include "dbconnect.php";

$enrollment = $_POST['enrollment'] ?? "";

/* Max Typing Score */
$maxRes = mysqli_query($conn, "SELECT MAX(typing_score) AS max_score FROM user");
$maxRow = mysqli_fetch_assoc($maxRes);
$maxTypingScore = $maxRow['max_score'] ?: 1;

$query = "
SELECT *,
(
    (typing_score / $maxTypingScore) * 100 +
    (quiz_score / 16000) * 100
) / 2 AS final_score
FROM user
";

if ($enrollment !== "") {
    $query .= " WHERE enrollment LIKE '%$enrollment%'";
}

$query .= " ORDER BY final_score DESC";

$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<tr><td colspan='10' style='color:red;'>No records found</td></tr>";
    exit;
}

$rank = 1;
while ($row = mysqli_fetch_assoc($result)) {

    // Medal logic
    if ($rank == 1) {
        $rankDisplay = "🥇";
    } elseif ($rank == 2) {
        $rankDisplay = "🥈";
    } elseif ($rank == 3) {
        $rankDisplay = "🥉";
    } else {
        $rankDisplay = $rank;
    }

    $typingPercent = round(100 * ($row['typing_score'] / $maxTypingScore), 2);
    $quizPercent   = round(100 * ($row['quiz_score'] / 16000), 2);
    $finalScore    = round($row['final_score'], 2);

    $statusClass = strtolower($row['status']) === "approved"
        ? "status-approved"
        : "status-pending";

    echo "
    <tr>
        <td>{$rankDisplay}</td>
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
                )\">Edit</button>
        </td>
    </tr>
    ";

    $rank++;
}
