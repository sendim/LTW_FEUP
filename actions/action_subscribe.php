<?php
include_once('../includes/session.php');
include_once('../includes/database.php');
include_once('../database/db_user.php');
include_once('../database/db_channel.php');


$channel = $_POST['title'];
$username = $_POST['username'];
$subscribed = $_POST['subscribed'];


try {
    if($subscribed == "Subscribe")
        userSubscribeChannel($username, $channel);
    else
        userUnsubscribeChannel($username, $channel);
    header('Location: ../pages/channels.php');
} catch (PDOException $e) {
    // redirect to last page showing error
    $_SESSION['error_messages'][] = "Failed creating new story";
    header('Location: ../pages/feed.php');
}

?>
