<?php
  include_once('../database/search.php');
  include_once('../templates/layout.php');
  include_once('../templates/feed.php');
 
  draw_layout(function(){
    $stories = get_feed();
    draw_feed($stories);
  });
?>