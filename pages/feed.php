<?php
  include_once('../database/db_search.php');
  include_once('../database/db_user.php');
  include_once('../database/db_channel.php');
  include_once('../templates/layout.php');
  include_once('../templates/feed.php');
 
  if (!isset($_SESSION['username'])) {
    $_SESSION['error_messages'][] = "Login Required!";
    die(header('Location: login.php'));
  }

  drawLayout(function(){

    $username = $_SESSION['username'];
    $userId = getUserId($username);

    if (isset($_GET['channelTitle'])) {
      $channelTitle = $_GET['channelTitle'];
      $channelId = getChannelId($channelTitle);
      $stories = getChannelStories($channelId);
      $currChannel = $channelTitle;
    } else {
      $stories = getFeed($userId);
      $currChannel = "";
    }
    
    $channels = getUserSubscribedChannels($username);

    drawFeed($stories,$channels,$currChannel);

  }, 'feed');
?>