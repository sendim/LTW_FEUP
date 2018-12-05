<?php
  include_once('../templates/layout.php');
  include_once('../templates/story.php');
  // TODO: Create channel.php include_once('../database/channel.php');
 
  if (!isset($_SESSION['username'])) {
    $_SESSION['error_messages'][] = "Login Required!";
    die(header('Location: login.php'));
  }

  drawLayout(function(){
    $channels = getChannels(); // TODO: create get channels function
    drawChannelsPage($channels);
  }, 'channels');
?>