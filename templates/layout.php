<?php function draw_layout($draw_content){ ?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  </head>
  <body>
    <nav id="navbar">
      <h1>The Fusion Network</h1>
        <a class="button" href="login.php">
        <img src="images/sign-in.svg" alt="Login">
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
            <a href="feed.php">
              <img src="images/repo.svg" alt="Feed">
              Feed
            </a>
          </li>
          <li>
            <a href="#">
              <img src="images/tag.svg" alt="Channels">
              Channels
            </a>
          </li>
          <li>
            <a href="#">
              <img src="images/person.svg" alt="Profile">
              Profile
            </a>
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