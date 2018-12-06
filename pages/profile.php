<?php
  include_once('../includes/session.php');
  include_once('../database/db_user.php');
  include_once('../templates/layout.php');
  include_once('../templates/profile.php');
    
  if (!isset($_SESSION['username'])) {
    $_SESSION['error_messages'][] = "Login Required!";
    die(header('Location: login.php'));
  } 

  drawLayout(function() {
    $profile = getUserProfile($_GET['username']);
    drawProfile($profile);
  }, 'profile');
?>