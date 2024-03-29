<?php
include_once '../includes/session.php';
include_once '../templates/tpl_layout.php';
include_once '../templates/tpl_profile.php';

// verify if user session is set
if (!isset($_SESSION['username'])) {
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

drawLayout(function () {
    $user = getUserProfile($_SESSION['username']);

    drawEditProfile($user);

}, 'editProfile');
