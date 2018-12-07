<?php
  include_once('../database/db_search.php');
  include_once('../templates/layout.php');
  include_once('../templates/channel.php');
 
  if (!isset($_SESSION['username'])) {
    $_SESSION['error_messages'][] = "Login Required!";
    die(header('Location: login.php'));
  }

  drawLayout(function(){
    drawChannelsPage($_SESSION['username']);
  }, 'channels');
?>