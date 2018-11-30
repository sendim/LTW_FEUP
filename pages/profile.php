<?php
  include_once('../includes/session.php');
  include_once('../database/user.php');
  include_once('../templates/layout.php');
  include_once('../templates/profile.php');
    
  draw_layout(function() {
    $profile = get_user_profile($_SESSION['username']);
    draw_profile($profile[0]);
  });
?>