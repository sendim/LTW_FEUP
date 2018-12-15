<?php
include_once '../templates/layout.php';
include_once '../templates/story.php';
include_once '../database/db_story.php';

// verify if user session is set
if (!isset($_SESSION['username'])) {
    $_SESSION['error_messages'][] = "Login Required!";
    die(header('Location: login.php'));
}

drawLayout(function () {
    // get page story id argument
    $storyID = $_GET['id'];
    $story = getStory($storyID);

    // draw story pages
    drawStoryPage($story);
}, 'story');
