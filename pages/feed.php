<?php
 include_once('../database/db_fusion.php');
 include_once('../templates/layout.php');
 include_once('../templates/feed.php');
 
  draw_layout(function(){
    $stories = get_feed();
    draw_feed($stories);
  });

?>