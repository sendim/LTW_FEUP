<?php
//include_once('../database/db_user.php');
include_once '../templates/tpl_layout.php';
include_once '../templates/tpl_channel.php';

if (!isset($_SESSION['username'])) {
    $_SESSION['error_messages'][] = "Login Required!";
    die(header('Location: login.php'));
}

drawLayout(function () {
    $username = $_SESSION['username'];

    $createdChannels = getUserCreatedChannels($username);

    $subscribedChannels = getUserSubscribedChannels($username);

    drawChannelsPage($createdChannels, $subscribedChannels);
}, 'channels');
