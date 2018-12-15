<?php
include_once '../includes/session.php';
include_once '../database/db_user.php';

if (!isset($_SESSION['username'])) {
    die(header('Location: ../pages/login.php'));
}

$username = $_SESSION['username'];
$csrf = $_GET['csrf'];

if ($_SESSION['csrf'] != $csrf) {
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

// process each post variable
$inputs = array('name', 'username', 'password', 'description');

foreach ($inputs as $input) {
    if (!empty($_POST[$input])) {
        switch ($input) {
            case 'name':
                updateUserName($username, $_POST['name']);
                break;
            case 'username':
                updateUserUsername($username, $_POST['username']);
                $username = $_POST['username'];
                $usernameOutdated = true;
                break;
            case 'password':
                updateUserPassword($username, $_POST['password']);
                break;
            case 'description':
                updateUserDescription($username, $_POST['description']);
                break;
        }
    }
}

if ($usernameOutdated) {
    $_SESSION['username'] = $username;
}

$_SESSION['success_messages'][] = 'Profile successfully edited!';
header('Location: ' . $_SERVER['HTTP_REFERER']);
