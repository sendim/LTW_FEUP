<?php
    include_once('../includes/session.php');
    include_once('../database/story.php');
    include_once('../database/user.php');

    $story_id = $_GET['story_id'];
    $username = $_SESSION['username'];
    $vote = $_GET['vote'];
    $csrf = $_GET['csrf'];

    // verifies csrf token
    if ($_SESSION['csrf'] != $csrf) {
        //$_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request!');
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }

    update_story_vote($story_id, $username, $vote);

    $author = get_author($story_id);
    update_user_points($author);
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>