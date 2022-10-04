<?php

include "../inc/database_connection.php";
session_start();

$prevPage = $_SERVER['HTTP_REFERER'];

$type = $_GET['type'];
$id = $_GET['id'];
$process = $_GET['process'];
$username = $_SESSION['username'];

if ($process == "like") {
    if ($type == "question") {
        $sql_addLike = "INSERT INTO questionlike (questionid, username) VALUES ($id, '$username')";
    } else {
        $sql_addLike = "INSERT INTO answerlike (answerid, username) VALUES ($id, '$username')";
    }
    $rs_addLike = mysqli_query($conn, $sql_addLike);
} else {
    if ($type == "question") {
        $sql_removeLike = "DELETE FROM questionlike WHERE questionid=$id AND username='$username'";
    } else {
        $sql_removeLike = "DELETE FROM answerlike WHERE answerid=$id AND username='$username'";
    }
    $rs_removeLike = mysqli_query($conn, $sql_removeLike);
}

header('location: ' . $prevPage);


?>