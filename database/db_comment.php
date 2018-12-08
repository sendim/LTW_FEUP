<?php
    include_once('../includes/database.php');
    include_once('../database/db_user.php');

    function addCommentOfComment($storyId,$commentId,$username,$commentText) {
        $db = Database::instance()->db();

        $userId = getUserId($username);

        $stmt = $db->prepare('INSERT INTO comment VALUES(NULL,?,?,?,?,?,?,?)');
        $ret = $stmt->execute(array($storyId,$userId,date("Y/m/d"),$commentText,0,0,$commentId));
        return $ret !== false;
    }

    function getCommentsOfComment($commentId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM comment WHERE referencedComment = ?');
        $stmt->execute(array($commentId));
        return $stmt->fetchAll();
    }

    function getCommentLikes($commentId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT likes FROM comment WHERE commentId = ?');
        $stmt->execute(array($commentId));
        return $stmt->fetch()['likes'];
    }

    function getCommentDislikes($commentId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT dislikes FROM comment WHERE commentId = ?');
        $stmt->execute(array($commentId));
        return $stmt->fetch()['dislikes'];
    }

    function getCommentStoryId($commentId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT storyId FROM comment WHERE commentId = ?');
        $stmt->execute(array($commentId));
        return $stmt->fetch()['storyId'];
    }
?>