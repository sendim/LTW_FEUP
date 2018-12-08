<?php 
  include_once('../includes/session.php');
  include_once('../database/db_user.php');

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
  <?php }

  function drawHeader($selected) {
  /**
  * Draws the page header
  */
    $sessionSet = isset($_SESSION['username']);
    $votingPages = array('feed','story','profile','channel');
    $channelCreationPage = 'channels';
    $commentCreationPage = 'story';
  ?>
    <!DOCTYPE html>
    <html lang="en-US">
      <head>
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <?php if (in_array($selected,$votingPages)) { ?>
          <script src="../js/storyVoteRequest.js" defer></script>
        <?php } if ($selected == $commentCreationPage) { ?>
          <script src="../js/addStoryCommentRequest.js" defer></script>
          <script src="../js/addCommentCommentRequest.js" defer></script>
        <?php } if ($selected == $channelCreationPage) { ?>
          <script src="../js/createChannelRequest.js" defer></script>
        <?php } ?>
      </head>
      <body>
        <nav id="navbar">
          <h1>The Fusion Network</h1>
            <?php if ($sessionSet) {
              $image = getUserProfilePhoto($_SESSION['username']);?>
              <a href="profile.php?username=<?=$_SESSION['username']?>">
                <?php if ($image != null) { ?>
                  <img class="profile-pic" src="../images/icons/<?=$image['imageId']?>.png">
                <?php } else { ?>
                  <img src="../images/icons/default.png">
                <?php } ?>
              </a>
              <?=$_SESSION['username']?>
              <a class="button" href="../actions/action_logout.php">
              <img src="icons/logout.svg" alt="Logout">
                Logout
              </a>
            <?php } ?>
          </button>
        </nav>
  <?php } 
  
  function drawMenu($selected) {
  /**
  * Draws the page menu section.
  */ 
    $sessionSet = isset($_SESSION['username']);
  ?>
    <nav id="menu">
      <div id="search">
        <input id="search-website"  name="search-website" placeholder="Search stories, comments..."/>
      </div>
      <ul>
        <li <?php if ($selected == 'feed') echo "id='menu-selected'"; ?> >
          <a href="<?php if($sessionSet) echo 'feed.php'; else echo '#';?>">
            <img src="icons/repo.svg" alt="Feed">
            Feed
          </a>
        </li>
        <li <?php if ($selected == 'channels') echo "id='menu-selected'"; ?>>
          <a href="<?php if($sessionSet) echo 'channels.php'; else echo '#';?>">
            <img src="icons/tag.svg" alt="Channels">
            Channels
          </a>
        </li>
        <li <?php if ($selected == 'profile') echo "id='menu-selected'"; ?>>
          <a href="<?php if($sessionSet) echo 'profile.php?username=' . $_SESSION['username']; else echo '#';?>">
            <img src="icons/person.svg" alt="Profile">
            Profile
          </a>
          <ul>
            <li>
              <a href="<?php if($sessionSet) echo 'editProfile.php'; else echo '#';?>">Edit profile</a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  <?php }

  function drawContent($drawContent) {
  /**
  * Draws the page content section.
  */?>
    <div id="content">
      <?php $drawContent(); ?>
  <?php }

  function drawMessages() {
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