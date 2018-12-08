<?php
    include_once('../includes/session.php');
    include_once('../database/db_story.php');
    include_once('../database/db_user.php');

    header('Content-Type: application/json');

    // verify if user is already logged in
    if (!isset($_SESSION['username']))
        die(json_encode(array('error' => 'not_logged_in')));

    // variables received for the request
    $storyId = $_POST['storyId'];
    $commentText = $_POST['commentText'];
    $csrf = $_POST['csrf'];

    // verifies csrf token
    if ($_SESSION['csrf'] != $csrf)
        die(json_encode(array('error' => 'incompatible_csrf')));

    // insert comment to the respective story
    $success = addStoryComment($commentText,$storyId,$_SESSION['username']);
    if ($success)
        echo json_encode(array('success' => 'Comment successfully added!'));
    else
        echo json_encode(array('error' => 'Comment could not be added!'));
?>