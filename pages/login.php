<?php
    include('../templates/header.php');
    include('../templates/auth.php');
    include('../templates/footer.php');

    // verify if user session is set
    if (isset($_SESSION['username']))
        die(header('Location: feed.php'));

    draw_header(null);
    draw_login();
    draw_footer();
?>