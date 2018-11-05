<?php function draw_header($username) {
/**
 * Draws the header for all pages.
 * If the user passed as a parameter is logged in,
 * the logout link is also output to the screen.
 */
?>

<!DOCTYPE html>
<html lang="en-US">
  <header>
   <title>The Fusion Network</title>
  </header>
  
  <body>
    <header>
      <h1><a href="../index.php">The Fusion Network</a></h1>
      <h2>Fuse your feelings!</h2>
      <?php if ($username != NULL) { ?>
        <nav>
          <ul>
            <li><?=username?></li>
            <li><a href="../actions/action_logout.php">Logout</a></li>
          </ul>
        </nav>
      <?php } ?>
    </header>
  <?php } ?>

  