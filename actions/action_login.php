<?php
include_once '../includes/session.php';
include_once '../database/db_user.php';

if (isset($_SESSION['username'])) {
    die(header('Location: ../pages/feed.php'));
}

$username = $_POST['username'];
$password = $_POST['password'];

if (userLogin($username, $password)) {
    setCurrentUser($username);
    header('Location: ../pages/feed.php');
} else {
    $_SESSION['error_messages'][] = "Login Failed!";
    header('Location: ../pages/login.php');
}
