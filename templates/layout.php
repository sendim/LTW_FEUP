<?php function draw_layout($draw_content){ ?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <link rel="stylesheet" href="style.css"></link>
  </head>
  <body>
    <nav id="navbar">
      <h1>The Fusion Network</h1>
      <button class="secondary">
        <a href="login.php">
          Login
        </a>
      </button>
    </nav>

    <div id="row">
      <nav id="menu">
        <div id="search">
          <input id="search-website"  name="search-website" placeholder="Search stories, comments..."/>
        </div>
        <ul>
          <li>
            <img src="images/repo.svg" alt="Feed">
            <a href="feed.php">Feed</a>
          </li>
          <li>
            <img src="images/tag.svg" alt="Channels">
            <a href="#">Channels</a>
          </li>
          <li>
            <img src="images/person.svg" alt="Profile">
            <a href="#">Profile</a>
          </li>
        </ul>
      </nav>
      <div id="content">
          <?php $draw_content(); ?>
      </div>
    </div>
  
 </body>
</html>

<?php }?>