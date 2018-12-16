<?php
include_once '../includes/session.php';
include_once '../database/db_user.php';

if (!isset($_SESSION['username'])) {
    die(header('Location: ../pages/login.php'));
}

$input = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['search']);
if ($input == '') {
    $_SESSION['error_messages'][] = "Search keywords can only contain letters and numbers!";
    die(header('Location: ../pages/feed.php'));
}

$searchLink = '../pages/search.php?input=' . $input;
header('Location: ' . $searchLink);
