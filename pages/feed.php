<?php
include_once '../database/db_search.php';
include_once '../database/db_user.php';
include_once '../database/db_channel.php';
include_once '../templates/tpl_layout.php';
include_once '../templates/tpl_feed.php';

if (!isset($_SESSION['username'])) {
    $_SESSION['error_messages'][] = "Login Required!";
    die(header('Location: login.php'));
}

drawLayout(function () {

    $username = $_SESSION['username'];
    $userId = getUserId($username);

    // display options
    $currChannel = '';
    $order = 'published';
    $sort = '';

    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
    }

    if (isset($_GET['order'])) {
        $order = $_GET['order'];
    }

    if (isset($_GET['channel'])) {
        $channel = $_GET['channel'];
        $channelId = getChannelId($channel);
        $stories = getChannelStories($channelId, $order, $sort);
        $currChannel = $channel;
    } else {
        $stories = getFeed($userId, $order, $sort);
    }

    $channels = getUserSubscribedChannels($username);

    drawFeed($stories, $channels, $currChannel);

}, 'feed');
