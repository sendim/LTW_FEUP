<?php
    include_once('../includes/session.php');
    include_once('../database/db_user.php');
    
    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));


    $_SESSION['search'] = $_GET['search'];

    header('Location: ../pages/search.php');

?>