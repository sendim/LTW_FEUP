<?php
    include_once('../templates/layout.php');
    include_once('../templates/newStory.php');
    include_once('../database/db_story.php');

    // verify if user session is set
    if (!isset($_SESSION['username'])) {
        $_SESSION['error_messages'][] = "Login Required!";
        die(header('Location: login.php'));
    }

    drawLayout(function() {
 
        // draw new story page
        drawNewStory();

    }, 'feed');
?>