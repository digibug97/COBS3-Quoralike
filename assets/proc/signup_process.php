<?php

include "../inc/database_connection.php";

$username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : "";
$password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : "";
$confirmPassword = isset($_POST['password2']) ? mysqli_real_escape_string($conn, $_POST['password2']) : "";

$lowercaseUsername = strtolower($username);

$sqlExistingUser = "SELECT username FROM user WHERE LOWER(username) = '$lowercaseUsername'";
$rsExistingUser = mysqli_query($conn, $sqlExistingUser);

if (mysqli_num_rows($rsExistingUser) != 0) {
    header('location: ../../signup.php?error=1');
} else {
    $password = password_hash($password, PASSWORD_BCRYPT);
    $sqlAddUser = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
    $rsAddUser = mysqli_query($conn, $sqlAddUser);
    session_start();
    $_SESSION['username'] = $username;
    header('location: ../../feed.php');
}
