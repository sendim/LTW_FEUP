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
$text = $_POST['text'];
$csrf = $_POST['csrf'];

$text = preg_replace('/[^a-zA-Z0-9]/', '', $text);
if ($text == '') {
    $_SESSION['error_messages'][] = "Comment can only contain letters and numbers!";
    die(json_encode(array('error' => 'invalid_chars')));
}

// verifies csrf token
if ($_SESSION['csrf'] != $csrf) {
    die(json_encode(array('error' => 'incompatible_csrf')));
}

try {
    // insert comment to the respective story
    $commentId = addComment($storyId, null, $text, $_SESSION['username']);
    echo json_encode(array('success' => $commentId));
} catch (PDOException $e) {
    echo json_encode(array('error' => 'Comment could not be added!'));
}
