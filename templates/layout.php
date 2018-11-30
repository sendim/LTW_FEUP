<?php 
  include_once('../includes/session.php');

  function draw_layout($draw_content){ ?>

  <!DOCTYPE html>
  <html lang="en-US">
    <head>
      <link rel="stylesheet" href="style.css">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body>
      <nav id="navbar">
        <h1>The Fusion Network</h1>
          <?php if (isset($_SESSION['username'])) { ?>
          <a class="button" href="../actions/action_logout.php">
          <img src="images/logout.svg" alt="Logout">
            Logout
          </a>
          <?php } ?>
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
              <a href="../pages/profile.php">
                <img src="images/person.svg" alt="Profile">
                Profile
              </a>
            </li>
          </ul>
        </nav>
        <div id="content">
            <?php $draw_content(); ?>
            <section id="messages">
              <?php $errors = get_error_messages(); foreach ($errors as $error) { ?>
                <article class="error">
                  <p><?=$error?></p>
                </article>
              <?php } clear_messages(); ?>
            </section>
        </div>
      </div>
    
  </body>
  </html>

<?php } ?>