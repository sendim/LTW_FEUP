<?php
    include('../templates/layout.php');
    include('../templates/auth.php');

    /*// verify if user session is set
    if (isset($_SESSION['username']))
        die(header('Location: feed.php'));
    */

    $content = function () {
        draw_signup();
    };

    draw_layout($content);
?>