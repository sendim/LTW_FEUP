<?php
include_once '../includes/session.php';
include_once '../database/db_user.php';

$username = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$description = $_POST['description'];

try {
    insertUser($username, $password, $name, $description);
    setCurrentUser($username);
    header('Location: ../pages/feed.php');
} catch (PDOException $e) {
    header('Location: ../pages/signup.php');
}
