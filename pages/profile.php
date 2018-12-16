<?php
include_once '../includes/session.php';
include_once '../database/db_user.php';
include_once '../templates/tpl_layout.php';
include_once '../templates/tpl_profile.php';

if (!isset($_SESSION['username'])) {
    $_SESSION['error_messages'][] = "Login Required!";
    die(header('Location: login.php'));
}

drawLayout(function () {
    $profile = getUserProfile($_GET['username']);

    // display options
    $order = 'published';
    $sort = '';

    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
    }

    if (isset($_GET['order'])) {
        $order = $_GET['order'];
    }

    drawProfile($profile, $order, $sort);
}, 'profile');
