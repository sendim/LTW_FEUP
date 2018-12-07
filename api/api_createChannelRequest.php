<?php
    include_once('../includes/session.php');
    include_once('../database/db_channel.php');

    header('Content-Type: application/json');

    // verify if user is already logged in
    if (!isset($_SESSION['username']))
        die(json_encode(array('error' => 'not_logged_in')));

    // variables received for the request
    $channelTitle = $_POST['channelTitle'];
    $csrf = $_POST['csrf'];

    // verifies csrf token
    if ($_SESSION['csrf'] != $csrf)
        die(json_encode(array('error' => 'incompatible_csrf')));

    createChannel($_SESSION['username'],$channelTitle);
?>