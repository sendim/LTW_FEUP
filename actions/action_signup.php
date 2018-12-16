<?php
include_once '../includes/session.php';
include_once '../database/db_user.php';

$username = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$description = $_POST['description'];

if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
    $_SESSION['error_messages'][] = 'Username can only contain letters and numbers!';
    die(header('Location: ../pages/signup.php'));
}

if (!preg_match("/^[a-zA-Z]+$/", $name)) {
    $_SESSION['error_messages'][] = 'Name can only contain letters and numbers!';
    die(header('Location: ../pages/signup.php'));
}

if (!preg_match("/^[a-zA-Z0-9]+$/", $description)) {
    $_SESSION['error_messages'][] = 'Description can only contain letters and numbers!';
    die(header('Location: ../pages/signup.php'));
}

try {
    insertUser($username, $password, $name, $description);
    setCurrentUser($username);
    header('Location: ../pages/feed.php');
} catch (PDOException $e) {
    header('Location: ../pages/signup.php');
}
