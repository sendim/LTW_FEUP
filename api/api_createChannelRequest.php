<?php
include_once '../includes/session.php';
include_once '../database/db_channel.php';
include_once '../database/db_user.php';

header('Content-Type: application/json');

// verify if user is already logged in
if (!isset($_SESSION['username'])) {
    die(json_encode(array('error' => 'not_logged_in')));
}

// variables received for the request
$channelTitle = $_POST['channelTitle'];
$csrf = $_POST['csrf'];

$channelTitle = preg_replace('/[^a-zA-Z]/', '', $channelTitle);
if ($channelTitle == '') {
    die(json_encode(array('error' => "Channel title can only contain letters!")));
}

// verifies csrf token
if ($_SESSION['csrf'] != $csrf) {
    die(json_encode(array('error' => 'incompatible_csrf')));
}

$success = createChannel($_SESSION['username'], $channelTitle);
if ($success) {
    echo json_encode(array('success' => $channelTitle));
} else {
    echo json_encode(array('error' => 'Channel already exists!'));
}
