<?php
include "dbconnect.php";

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="results.csv"');

$output = fopen("php://output", "w");
fputcsv($output, [
    "Rank", "Enrollment", "Name", "Typing %", "Quiz %", "Final Score"
]);

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
ORDER BY final_score DESC
";

$res = mysqli_query($conn, $query);
$rank = 1;

while ($row = mysqli_fetch_assoc($res)) {

    $typing = round(100 * ($row['typing_score'] / $maxTypingScore), 2);
    $quiz   = round(100 * ($row['quiz_score'] / 16000), 2);
    $final  = round($row['final_score'], 2);

    fputcsv($output, [
        $rank,
        $row['enrollment'],
        $row['name'],
        $typing . "%",
        $quiz . "%",
        $final . "%"
    ]);

    $rank++;
}

fclose($output);
exit;
