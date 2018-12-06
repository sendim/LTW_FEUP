<?php
    include_once('../includes/session.php');
    include_once('../database/db_story.php');
    include_once('../database/db_user.php');

    header('Content-Type: application/json');

    // verify if user is already logged in
    if (!isset($_SESSION['username']))
        die(json_encode(array('error' => 'not_logged_in')));

    // variables received for the request
    $username = $_POST['username'];
    $storyId = $_POST['storyId'];
    $vote = $_POST['vote'];
    $csrf = $_POST['csrf'];

    // verifies csrf token
    if ($_SESSION['csrf'] != $csrf)
        die(json_encode(array('error' => 'incompatible_csrf')));

    // update story votes
    updateStoryVote($storyId, $username, $vote);

    // update story author points
    $author = getStoryAuthor($storyId);
    updateUserPoints($author);

    // send new story likes & dislikes values
    $ret = array(
        'likes' => getStoryLikes($storyId),
        'dislikes' => getStoryDislikes($storyId),
        'userPoints' => getUserPoints($author)
    );

    echo json_encode($ret);
?>