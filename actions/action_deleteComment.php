<?php
include_once '../includes/session.php';
include_once '../database/db_comment.php';
include_once '../database/db_user.php';

$username = $_SESSION['username'];
$commentId = $_GET['commentId'];
$csrf = $_GET['csrf'];

if ($_SESSION['csrf'] != $csrf) {
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

try {
    if (getCommentAuthor($commentId) != $username) {
        // redirect to last page showing error
        $_SESSION['error_messages'][] = "No permission to delete comment!";
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }

    // delete comment
    deleteComment($commentId);
    updateUserPoints($username);

    $_SESSION['success_messages'][] = "Comment deleted successfully!";
    header('Location: ' . $_SERVER['HTTP_REFERER']);

} catch (PDOException $e) {
    // redirect to last page showing error
    $_SESSION['error_messages'][] = "Failed deleting comment!";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
