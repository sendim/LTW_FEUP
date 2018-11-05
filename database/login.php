<?php

 include_once('database/db_fusion.php');
 include_once('templates/header.php');

  $articles = getFeed();
  foreach( $articles as $article) {
    echo '<h1>' . $article['title'] . '</h1>';
    echo '<p>' . $article['fulltext'] . '</p>';
    
    echo '<footer>'; 
      echo '<p>' . $article['username'] . " " . $article['published'] . '</p>';
    echo '</footer>';
  }

  include_once('templates/footer.php');
?>