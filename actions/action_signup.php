<?php 
    include_once('../includes/session.php');
    include_once('../database/user.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullName = $_POST['fullName'];
    $description = $_POST['description'];

    try {
        insert_user($username,$password,$fullName,$description);
        set_current_user($username);
        header('Location: ../pages/feed.php');
    } catch(PDOException $e) {
        header('Location: ../pages/signup.php');
    }
?>