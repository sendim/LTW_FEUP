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
                if (!preg_match('/^[a-zA-Z]+$/', $_POST[$input])) {
                    $_SESSION['error_messages'][] = 'Name can only contain letters!';
                    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
                }
                updateUserName($username, $_POST['name']);
                break;
            case 'username':
                if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST[$input])) {
                    $_SESSION['error_messages'][] = 'Username can only contain letters and numbers!';
                    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
                }
                updateUserUsername($username, $_POST['username']);
                $username = $_POST['username'];
                $usernameOutdated = true;
                break;
            case 'password':
                updateUserPassword($username, $_POST['password']);
                break;
            case 'description':
                if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST[$input])) {
                    $_SESSION['error_messages'][] = 'Description can only contain letters and numbers!';
                    die(header('Location: ../pages/signup.php'));
                }
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
