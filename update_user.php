<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "dbconnect.php";

if (
    !isset($_POST['enrollment']) ||
    !isset($_POST['wpm']) ||
    !isset($_POST['quiz'])
) {
    echo "invalid_request";
    exit;
}

$enrollment = trim($_POST['enrollment']);
$wpm = trim($_POST['wpm']);
$quiz = trim($_POST['quiz']);

/*
CASE-INSENSITIVE + TRIM-SAFE UPDATE
*/
$query = "
    UPDATE `user`
    SET wpm = '$wpm',
        quiz = '$quiz'
    WHERE TRIM(LOWER(enrollment)) = TRIM(LOWER('$enrollment'))
";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo "sql_error: " . mysqli_error($conn);
    exit;
}

if (mysqli_affected_rows($conn) === 0) {
    echo "no_row_updated";
    exit;
}

echo "success";
