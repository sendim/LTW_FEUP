<?php
include_once('../includes/session.php');
include_once('../includes/database.php');
include_once('../database/db_story.php');
include_once('../database/db_user.php');
include_once('../database/db_channel.php');

$username = $_SESSION['username'];
$title = $_POST['title'];
$text = $_POST['text'];
$channel = $_POST['channel'];

// get user id
$userId = getUserId($username);

// get channel id
$channelId = getChannelId($channel);

try {
    // add new story
    $storyId = addStory($title,$text,$userId,$channelId);
    // redirect to created story page
    header('Location: ../pages/story.php?id=' . $storyId);
} catch (PDOException $e) {
    // redirect to last page showing error
    $_SESSION['error_messages'][] = "Failed creating new story";
    header('Location: ../pages/newStory.php');
}

?>
