<?php

include "../inc/database_connection.php";


session_start();

$title = $_POST['title'];
$body = $_POST['body'];
$username = $_SESSION['username'];

$sql_ask = "INSERT INTO question (title, body, username) VALUES ('$title', '$body', '$username')";
$rs_ask = mysqli_query($conn, $sql_ask);

$id = mysqli_insert_id($conn);
echo $id;

header('location: ../../question.php?id=' . $id);

?>