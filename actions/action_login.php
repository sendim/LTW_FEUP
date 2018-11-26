<?php 
    include_once('../includes/session.php');
    include_once('../database/db_fusion.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (user_login($username,$password)) {
        set_current_user($username);
        header('Location: ../pages/feed.php');
    } else {
        header('Location: ../pages/login.php');
    }
?>