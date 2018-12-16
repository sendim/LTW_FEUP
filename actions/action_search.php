<?php
include_once '../includes/session.php';
include_once '../database/db_user.php';

if (!isset($_SESSION['username'])) {
    die(header('Location: ../pages/login.php'));
}

$input = $_GET['search'];
$input = preg_replace('/%/', '', $input);
//$input = preg_replace('\'', '', $input);

if ($input == null || $input == '') {
    die(header('Location: ../pages/feed.php'));
}

$searchLink = '../pages/search.php?input=' . $input;
header('Location: ' . $searchLink);
