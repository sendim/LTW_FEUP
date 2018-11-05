<?php
 include_once('database/db_redeSocial.php');
 include_once('templates/header.php');

$articles = getFeed();
 

    foreach( $articles as $article) {
    echo '<h1>' . $article['title'] . '</h1>';
    echo '<p>' . $article['text'] . '</p>';
   
    echo '<footer>'; 
      echo '<p>' . $article['username'] . " " . $article['published'] . '</p>';
    echo '</footer>';

  }


  include_once('templates/footer.php');
  ?>
