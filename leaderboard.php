<?php include "dbconnect.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Leaderboard</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<div class="box">
    <h2>🏆 Leaderboard</h2>

    <table>
        <tr>
            <th>Rank</th>
            <th>Name</th>
            <th>Final Score</th>
        </tr>

<?php
$maxRes = mysqli_query($conn, "SELECT MAX(typing_score) AS max_score FROM user");
$maxRow = mysqli_fetch_assoc($maxRes);
$maxTypingScore = $maxRow['max_score'] ?: 1;

$query = "
SELECT name,
    (
        (typing_score / $maxTypingScore) * 100 +
        (quiz_score / 16000) * 100
    ) / 2 AS final_score
FROM user
ORDER BY final_score DESC
LIMIT 10
";

$res = mysqli_query($conn, $query);
$rank = 1;

while ($row = mysqli_fetch_assoc($res)) {

    if ($rank == 1) {
        $rankDisplay = "<i class='fa-solid fa-medal gold'></i>";
    } elseif ($rank == 2) {
        $rankDisplay = "<i class='fa-solid fa-medal silver'></i>";
    } elseif ($rank == 3) {
        $rankDisplay = "<i class='fa-solid fa-medal bronze'></i>";
    } else {
        $rankDisplay = $rank;
    }

    echo "<tr>
        <td>{$rankDisplay}</td>
        <td>{$row['name']}</td>
        <td><strong>" . round($row['final_score'], 2) . "%</strong></td>
    </tr>";

    $rank++;
}

?>

    </table>

    <br>
    <button onclick="window.location='home.php'" class="btn-cancel">⬅ Back</button>
</div>

</body>
</html>