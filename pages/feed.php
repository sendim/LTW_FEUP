<?php
  include_once('../includes/session.php');
  include_once('../database/search.php');
  include_once('../templates/layout.php');
  include_once('../templates/feed.php');
 
  if (!isset($_SESSION['username'])) {
    $_SESSION['error_messages'][] = "Login Required!";
    die(header('Location: login.php'));
  }

  draw_layout(function(){
    $stories = get_feed();
    draw_feed($stories);
  });
?>