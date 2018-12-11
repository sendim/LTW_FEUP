<?php
include_once('../includes/session.php');
include_once('../database/db_user.php');

$username = $_SESSION['username'];
$userId = getUserId($username);

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

?>
