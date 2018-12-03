<?php
    include_once('../templates/layout.php');
    include_once('../templates/auth.php');

    // verify if user session is set
    if (isset($_SESSION['username']))
        die(header('Location: feed.php'));

    draw_layout(function () {
        draw_signup();
    }, 'signup');
?>