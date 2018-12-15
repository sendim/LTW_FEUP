<?php
include_once '../includes/session.php';
include_once '../database/db_user.php';

$username = $_SESSION['username'];
$csrf = $_GET['csrf'];

if ($_SESSION['csrf'] != $csrf) {
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

// get user id
$userId = getUserId($username);

try {
    // delete user account
    deleteUser($userId);
    // redirect to created story page
    session_destroy();
    header('Location: ../pages/login.php');
} catch (PDOException $e) {
    // redirect to last page showing error
    $_SESSION['error_messages'][] = "Failed deleting account";
    header('Location: ../pages/profile.php?username=' . $username);
}
