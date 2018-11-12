<?php
 include_once('../database/db_fusion.php');
 include_once('../templates/layout.php');

 $content = function() {
  $stories = getFeed();
  foreach( $stories as $storie) {
    echo '<h1>' . $storie['title'] . '</h1>';
    echo '<p>' . $storie['text'] . '</p>';
    
    echo '<footer>'; 
      echo '<p>' . $storie['username'] . " " . $storie['published'] . '</p>';
    echo '</footer>';
  }
 };
 

  draw_layout($content);
?>