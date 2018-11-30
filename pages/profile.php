<?php
  include_once('../includes/session.php');
  include_once('../database/user.php');
  include_once('../templates/layout.php');
  include_once('../templates/profile.php');
    
  if (!isset($_SESSION['username'])) {
    $_SESSION['error_messages'][] = "Login Required!";
    die(header('Location: login.php'));
  }

  draw_layout(function() {
    $profile = get_user_profile($_SESSION['username']);
    draw_profile($profile[0]);
  });
?>