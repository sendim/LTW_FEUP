<?php
include_once '../includes/session.php';
include_once '../database/db_user.php';

function drawLayout($drawContent, $selected)
{
    /**
     * Draws a typical page section.
     */
    drawHeader($selected)?>
      <div id="row">
        <?php
drawMenu($selected);
    drawContent($drawContent);
    ?>
      </div>
      <footer id="footer">
        LTW 2018, all rights reserved.
      </footer>
    </body>
    </html>
  <?php }

function drawHeader($selected)
{
    /**
     * Draws the page header
     */
    $sessionSet = isset($_SESSION['username']);
    $votingPages = array('search', 'feed', 'story', 'profile', 'channel');
    $channelCreationPage = 'channels';
    $commentCreationPage = 'story';
    $commentVotingPage = array('story', 'profile');
    $sortingPage = 'feed';
    $profilePage = 'profile';
    ?>
    <!DOCTYPE html>
    <html lang="en-US">
      <head>
        <link rel="stylesheet" href="../css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <?php if (in_array($selected, $votingPages)) {?>
          <script src="../js/storyVoteRequest.js" defer></script>
        <?php }if (in_array($selected, $commentVotingPage)) {?>
          <script src="../js/commentVoteRequest.js" defer></script>
        <?php }if ($selected == $commentCreationPage) {?>
          <script src="../js/addStoryCommentRequest.js" defer></script>
          <script src="../js/addCommentCommentRequest.js" defer></script>
        <?php }if ($selected == $channelCreationPage) {?>
          <script src="../js/createChannelRequest.js" defer></script>
        <?php }if ($selected == $profilePage) {?>
          <script src="../js/getSortedStoriesProfile.js" defer></script>
        <?php }if ($selected == $sortingPage) {?>
             <script src="../js/getSortingRequest.js" defer></script>
        <?php }?>
      </head>
      <body>
        <nav id="navbar">
          <a href="../pages/feed.php">
            <h1>The Fusion Network</h1>
          </a>
        </nav>
  <?php }

function drawMenu($selected)
{
    /**
     * Draws the page menu section.
     */
    $sessionSet = isset($_SESSION['username']);

    $username = $sessionSet ? $_SESSION['username'] : null;

    $image = $sessionSet ? getUserProfilePhoto($username) : null;
    ?>
    <nav id="menu" >
      <div id="user-info">
        <?php if ($sessionSet) {?>
          <div id="pic-and-name">
            <a href="profile.php?username=<?=$username?>">
              <?php if ($image != null) {?>
                <img class="profile-pic responsive" src="../images/icons/<?=$image['imageId']?>jpg">
              <?php } else {?>
                <img class="profile-pic responsive" src="../images/icons/default.jpg">
              <?php }?>
            </a>

            <h4>@<?=$username?></h4>
          </div>

          <div id="buttons">
            <a class="button terciary" href="../actions/action_logout.php">
              <img src="icons/logout.svg" alt="Logout">
                Logout
            </a>
            <a class="button secondary" href="editProfile.php">
              <img src="icons/pencil.svg" alt="Edit profile">
                Edit
            </a>
          </div>
        <?php }?>
      </div>

      <div id="search">
        <form method="get" action="../actions/action_search.php">
          <input
            id="search-input"
            type="text"
            name="search"
            placeholder="Search stories, comments..."
            required
            class="<?php if ($sessionSet) {
        echo "";
    } else {
        echo "disabled";
    }
    ?>"
          >
        </form>
      </div>
      <ul>
        <li <?php if ($selected == 'feed') {
        echo "id='menu-selected'";
    }
    ?> >
          <a href="feed.php" class=<?php if ($sessionSet) {
        echo "";
    } else {
        echo "disabled";
    }
    ?> >
            <img src="icons/repo.svg" alt="Feed">
            Feed
          </a>
        </li>
        <li <?php if ($selected == 'channels') {
        echo "id='menu-selected'";
    }
    ?>>
          <a href="channels.php" class=<?php if ($sessionSet) {
        echo "";
    } else {
        echo "disabled";
    }
    ?>>
            <img src="icons/tag.svg" alt="Channels">
            Channels
          </a>
        </li>
        <li <?php if ($selected == 'profile') {
        echo "id='menu-selected'";
    }
    ?>>
          <a href="profile.php?username=<?=$username?>" class=<?php if ($sessionSet) {
        echo "";
    } else {
        echo "disabled";
    }
    ?>>
            <img src="icons/person.svg" alt="Profile">
            Profile
          </a>
        </li>
      </ul>
    </nav>
  <?php }

function drawContent($drawContent)
{
    /**
     * Draws the page content section.
     */?>
    <div id="content">
      <?php
drawMessages();
    $drawContent();
    ?>
    </div>
  <?php }

function drawMessages()
{
    /**
     * Draws the page message section.
     */?>
        <section id="messages">
          <?php $errors = getErrorMessages();foreach ($errors as $error) {?>
            <article class="error">
              <p><?=$error?></p>
            </article>
          <?php }
    $successes = getSuccessMessages();foreach ($successes as $success) {?>
            <article class="success">
              <p><?=$success?></p>
            </article>
          <?php }
    clearMessages();?>
        </section>

  <?php }?>