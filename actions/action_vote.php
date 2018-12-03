<?php

    include_once('../includes/session.php');
    include_once('../database/story.php');

    $story_id = $_GET['story_id'];
    $username = $_SESSION['username'];
    $vote = $_GET['vote'];
    $csrf = $_GET['csrf'];

    // verifies csrf token
    if ($_SESSION['csrf'] != $csrf) {
        //$_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request!');
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }

    update_story_votes($story_id, $username, $vote);
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>