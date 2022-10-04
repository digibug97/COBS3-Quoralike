<?php

include "../inc/database_connection.php";
session_start();

$prevPage = $_SERVER['HTTP_REFERER'];

$questionId = $_GET['id'];
$answer = $_POST['answer'];
$username = $_SESSION['username'];

$sql_newAnswer = "INSERT INTO answer(questionid, text, username) VALUES ($questionId, '$answer', '$username')";
$rs_newAnswer = mysqli_query($conn, $sql_newAnswer);

header('location: ' . $prevPage);

?>
