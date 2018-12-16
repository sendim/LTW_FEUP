<?php
include_once '../includes/database.php';
include_once '../database/db_user.php';

function addComment($storyId, $refCommentId, $text, $username)
{
    $db = Database::instance()->db();
    $userId = getUserId($username);
    $stmt = $db->prepare('INSERT INTO comment VALUES(NULL,?,?,?,?,?,?,?)');
    $stmt->execute(array($storyId, $userId, date('Y:m:d H:i:s'), $text, 0, 0, $refCommentId));
    return $db->lastInsertId();
}

function addUserCommentVote($commentId, $username, $vote)
{
    $db = Database::instance()->db();
    $userId = getUserId($username);
    $stmt = $db->prepare('INSERT INTO votesComment VALUES(?,?,?)');
    $stmt->execute(array($userId, $commentId, $vote));
}

function deleteComment($commentId)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('DELETE FROM comment WHERE commentId = ?');
    $stmt->execute(array($commentId));
}

function getCommentAuthor($commentId)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT username FROM comment NATURAL JOIN user WHERE commentId = ?');
    $stmt->execute(array($commentId));
    return $stmt->fetch()['username'];
}

function getCommentsOfComment($commentId)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM comment WHERE referencedComment = ?');
    $stmt->execute(array($commentId));
    return $stmt->fetchAll();
}

function getCommentLikes($commentId)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT SUM(vote) as likes
            FROM votesComment
            WHERE commentId = ?'
    );
    $stmt->execute(array($commentId));

    $result = $stmt->fetch()['likes'];
    if ($result != null) {
        return $result;
    } else {
        return 0;
    }

}

function getCommentStoryId($commentId)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT storyId FROM comment WHERE commentId = ?');
    $stmt->execute(array($commentId));
    return $stmt->fetch()['storyId'];
}

function userVotedComment($commentId, $username)
{
    $db = Database::instance()->db();

    $userId = getUserId($username);

    $stmt = $db->prepare(
        'SELECT *
            FROM votesComment
            WHERE commentId = ? AND userId = ?'
    );
    $stmt->execute(array($commentId, $userId));

    return $stmt->fetchAll() ? true : false;
}

function updateCommentVote($commentId, $username, $vote)
{
    if (userVotedComment($commentId, $username)) {
        if ($vote == 1) {
            upvoteComment($commentId, $username);
        } else if ($vote == -1) {
            downvoteComment($commentId, $username);
        }

    } else {
        addUserCommentVote($commentId, $username, $vote);
    }

    $db = Database::instance()->db();
    $updateStmt = $db->prepare(
        'UPDATE comment
            SET likes = ?
            WHERE commentId = ?'
    );
    $updateStmt->execute(array(
        getCommentLikes($commentId),
        $commentId)
    );
}

function upvoteComment($commentId, $username)
{
    $db = Database::instance()->db();

    $userId = getUserId($username);

    $stmt = $db->prepare(
        'UPDATE votesComment
            SET vote = ?
            WHERE userId = ? AND commentId = ?'
    );
    $stmt->execute(array(1, $userId, $commentId));
}

function downvoteComment($commentId, $username)
{
    $db = Database::instance()->db();

    $userId = getUserId($username);

    $stmt = $db->prepare(
        'UPDATE votesComment
            SET vote = ?
            WHERE userId = ? AND commentId = ?'
    );
    $stmt->execute(array(-1, $userId, $commentId));
}
