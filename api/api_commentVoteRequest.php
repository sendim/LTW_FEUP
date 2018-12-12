<?php
    include_once('../includes/session.php');
    include_once('../database/db_comment.php');
    include_once('../database/db_user.php');

    header('Content-Type: application/json');

    // verify if user is already logged in
    if (!isset($_SESSION['username']))
        die(json_encode(array('error' => 'not_logged_in')));

    // variables received for the request
    $username = $_POST['username'];
    $commentId = $_POST['commentId'];
    $vote = $_POST['vote'];
    $csrf = $_POST['csrf'];

    // verifies csrf token
    if ($_SESSION['csrf'] != $csrf)
        die(json_encode(array('error' => 'incompatible_csrf')));

    // update comment votes
    updateCommentVote($commentId, $username, $vote);

    // update story author points
    $author = getCommentAuthor($commentId);
    updateUserPoints($author);

    // send new comment likes & dislikes values
    $ret = array(
        'likes' => getCommentLikes($commentId),
        'dislikes' => getCommentDislikes($commentId),
        'userPoints' => getUserPoints($author)
    );

    echo json_encode($ret);
?>