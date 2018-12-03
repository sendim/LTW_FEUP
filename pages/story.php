<?php
    include_once('../templates/layout.php');
    include_once('../templates/story.php');
    include_once('../database/story.php');

    // verify if user session is set
    if (!isset($_SESSION['username'])) {
        $_SESSION['error_messages'][] = "Login Required!";
        die(header('Location: login.php'));
    }

    draw_layout(function(){
         // get page story id argument
        $storyID = $_GET['id'];
        $story =  get_story($storyID);

        // draw story pages
        draw_story_page($story);
    });
?>