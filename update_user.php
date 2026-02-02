<?php
include "dbconnect.php";

$enrollment = $_POST['enrollment'];
$wpm = $_POST['wpm'];
$accuracy = $_POST['accuracy'];
$quiz_score = $_POST['quiz_score'];

/* Typing Score Formula */
$typing_score = $wpm * ($accuracy / 100);

$query = "
UPDATE user
SET
    wpm = '$wpm',
    accuracy = '$accuracy',
    typing_score = '$typing_score',
    quiz_score = '$quiz_score'
WHERE enrollment = '$enrollment'
";

if (mysqli_query($conn, $query)) {
    echo "success";
} else {
    echo "error";
}
