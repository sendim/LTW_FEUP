<?php
    include('../database/db_channel.php');
    
    if (!isset($_SESSION['username'])) {
        $_SESSION['error_messages'][] = "Login Required!";
        die(header('Location: login.php'));
    }
    
    

?>