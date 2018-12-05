<?php 
  include_once('../includes/session.php');

  function drawLayout($drawContent, $selected) {
  /**
  * Draws a typical page section.
  */
      drawHeader($selected) ?>
      <div id="row">
        <?php
          drawMenu($selected); 
          drawContent($drawContent);
          drawMessages();
        ?>
      </div>
    </body>
    </html>
  <?php } ?>

  <?php function drawHeader($selected) {
  /**
  * Draws the page header
  */?>
    <!DOCTYPE html>
    <html lang="en-US">
      <head>
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <?php if ($selected == 'feed' || $selected == 'story' || $selected == 'profile') { ?>
          <script src="../js/voteRequest.js" defer></script>
        <?php } ?>
      </head>
      <body>
        <nav id="navbar">
          <h1>The Fusion Network</h1>
            <?php if (isset($_SESSION['username'])) { ?>
            <a class="button" href="../actions/action_logout.php">
            <img src="icons/logout.svg" alt="Logout">
              Logout
            </a>
            <?php } ?>
          </button>
        </nav>
  <?php } ?>

  <?php 
  /**
  * Draws the page menu section.
  */
  function drawMenu($selected) { ?>
      <nav id="menu">
        <div id="search">
          <input id="search-website"  name="search-website" placeholder="Search stories, comments..."/>
        </div>
        <ul>
          <li <?php if ($selected == 'feed') echo "id='menu-selected'"; ?> >
            <a href="feed.php">
              <img src="icons/repo.svg" alt="Feed">
              Feed
            </a>
          </li>
          <li <?php if ($selected == 'channels') echo "id='menu-selected'"; ?>>
            <a  href="channels.php">
              <img src="icons/tag.svg" alt="Channels">
              Channels
            </a>
          </li>
          <li <?php if ($selected == 'profile') echo "id='menu-selected'"; ?>>
            <a href="profile.php">
              <img src="icons/person.svg" alt="Profile">
              Profile
            </a>
            <!-- added edit profile -->
            <ul>
              <li>
                <a href="editProfile.php">Edit profile</a>
              </li>
            </ul>
            <!-- end of change -->
          </li>
        </ul>
    </nav>
  <?php } ?>

  <?php function drawContent($drawContent) {
  /**
  * Draws the page content section.
  */?>
    <div id="content">
        <?php $drawContent(); ?>
  <?php } ?>

  <?php function drawMessages() {
  /**
  * Draws the page message section.
  */?>
        <section id="messages">
          <?php $errors = getErrorMessages(); foreach ($errors as $error) { ?>
            <article class="error">
              <p><?=$error?></p>
            </article>
          <?php } $successes = getSuccessMessages(); foreach ($successes as $success) { ?>
            <article class="success">
              <p><?=$success?></p>
            </article>
          <?php } clearMessages(); } ?>
        </section>
    </div>