<?php
    include_once('../includes/session.php');

    header('Content-Type: application/json');

    // verify if user is already logged in
    if (!isset($_SESSION['username']))
        die(json_encode(array('error' => 'not_logged_in')));

    // variables received for the request
    $commentId = $_POST['commentId'];
    $commentText = $_POST['commentText'];
    $csrf = $_POST['csrf'];

    // verifies csrf token
    if ($_SESSION['csrf'] != $csrf)
        die(json_encode(array('error' => 'incompatible_csrf')));

    // insert comment to the respective story
    $success = addCommentOfComment($storyId,$commentId,$_SESSION['username'],$commentText);
    if ($success)
        echo json_encode(array('success' => 'Comment successfully added!'));
    else
        echo json_encode(array('error' => 'Comment could not be added!'));
?>