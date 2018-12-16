<?php
include_once '../includes/session.php';
include_once '../database/db_story.php';
include_once '../database/db_user.php';

$username = $_SESSION['username'];
$storyId = $_GET['storyId'];
$csrf = $_GET['csrf'];

if ($_SESSION['csrf'] != $csrf) {
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

try {

    if (getStoryAuthor($storyId) != $username) {
        // redirect to last page showing error
        $_SESSION['error_messages'][] = "No permission to delete story!";
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }

    // delete story
    deleteStory($storyId);
    updateUserPoints($username);

    $_SESSION['success_messages'][] = "Story deleted successfully!";
    header('Location: ../pages/feed.php');

} catch (PDOException $e) {
    // redirect to last page showing error
    $_SESSION['error_messages'][] = "Failed deleting story!";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
