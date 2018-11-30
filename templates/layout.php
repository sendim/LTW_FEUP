<?php 
  include_once('../includes/session.php');

  function draw_layout($draw_content) {
  /**
  * Draws a typical page section.
  */
      draw_header() ?>
      <div id="row">
        <?php
          draw_menu(); 
          draw_content($draw_content);
          draw_messages();
        ?>
      </div>
    </body>
    </html>
  <?php } ?>

  <?php function draw_header() { 
  /**
  * Draws the page header.
  */?>
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
  <?php } ?>

  <?php function draw_menu() {
  /**
  * Draws the page menu section.
  */?>
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
  <?php } ?>

  <?php function draw_content($draw_content) {
  /**
  * Draws the page content section.
  */?>
    <div id="content">
        <?php $draw_content(); ?>
  <?php } ?>

  <?php function draw_messages() {
  /**
  * Draws the page message section.
  */?>
        <section id="messages">
          <?php $errors = get_error_messages(); foreach ($errors as $error) { ?>
            <article class="error">
              <p><?=$error?></p>
            </article>
          <?php } $successes = get_success_messages(); foreach ($successes as $success) { ?>
            <article class="success">
              <p><?=$success?></p>
            </article>
          <?php } clear_messages(); } ?>
        </section>
    </div>