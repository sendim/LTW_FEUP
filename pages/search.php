<?php
  include_once('../database/db_search.php');
  include_once('../templates/layout.php');
  include_once('../templates/search.php');
 
  if (!isset($_SESSION['username'])) {
    $_SESSION['error_messages'][] = "Login Required!";
    die(header('Location: login.php'));
  }


  drawLayout(function(){

    $input = $_GET['input'];
    $profiles = searchProfiles($input);
    $stories = searchStory($input);
    $comments = searchComments($input);
    $channels = searchChannels($input);
    drawSearchFeed($profiles, $stories, $comments, $channels);
  }, 'search');
  
?>
