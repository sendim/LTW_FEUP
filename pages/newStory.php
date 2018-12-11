<?php
    include_once('../templates/layout.php');
    include_once('../templates/newStory.php');
    include_once('../database/db_story.php');
    include_once('../database/db_search.php');

    // verify if user session is set
    if (!isset($_SESSION['username'])) {
        $_SESSION['error_messages'][] = "Login Required!";
        die(header('Location: login.php'));
    }

    drawLayout(function() {
 
        $channels = getChannels();
        
        if (isset($_GET['channel']))
         $selectedChannel = $_GET['channel'];
        else
         $selectedChannel = null;

        // draw new story page
        drawNewStory($channels,$selectedChannel);

    }, 'feed');
?>