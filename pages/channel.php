<?php
    include_once('../includes/session.php');
    include_once('../database/db_channel.php');
    include_once('../templates/layout.php');
    include_once('../templates/channel.php');
    
    if (!isset($_SESSION['username'])) {
        $_SESSION['error_messages'][] = "Login Required!";
        die(header('Location: login.php'));
    }
    
    drawLayout(function() {
        $channelTitle = $_GET['title'];
        drawChannel($channelTitle);
    }, 'channel');
?>