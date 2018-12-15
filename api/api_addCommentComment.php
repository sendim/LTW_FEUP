<?php
include_once '../includes/session.php';
include_once '../database/db_comment.php';
include_once '../database/db_user.php';

header('Content-Type: application/json');

// verify if user is already logged in
if (!isset($_SESSION['username'])) {
    die(json_encode(array('error' => 'not_logged_in')));
}

// variables received for the request
$storyId = $_POST['storyId'];
$refCommentId = $_POST['refCommentId'];
$text = $_POST['text'];
$csrf = $_POST['csrf'];

// verifies csrf token
if ($_SESSION['csrf'] != $csrf) {
    die(json_encode(array('error' => 'incompatible_csrf')));
}

try {
    // insert comment to the respective referenced comment
    $commentId = addComment($storyId, $refCommentId, $text, $_SESSION['username']);
    echo json_encode(array('success' => $commentId));
} catch (PDOException $e) {
    echo json_encode(array('error' => 'Comment could not be added!'));
}
