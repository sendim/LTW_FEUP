<?php
    include_once('../includes/session.php');
    include_once('../includes/database.php');

    function addStory($title, $text, $userId, $channelId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO story VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($title,date("Y/m/d"),$userId,$text,0,0,$channelId));
        return $db->lastInsertId();
    }

    function addUserVote($storyId, $username, $vote) {
        $db = Database::instance()->db();
        $userId = getUserId($username);
        $stmt = $db->prepare('INSERT INTO votesStory VALUES(?,?,?)');
        $stmt->execute(array($userId, $storyId, $vote));
    }

    function addStoryComment($comment,$storyId,$username) {
        $db = Database::instance()->db();
        $userId = getUserId($username);
        $stmt = $db->prepare('INSERT INTO comment VALUES(NULL,?,?,?,?,?,?,NULL)');
        $ret = $stmt->execute(array($storyId,$userId,date("Y/m/d"),$comment,0,0));
        return $ret !== false;
    }

    function getStory($storyId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM story WHERE storyId = ?');
        $stmt->execute(array($storyId));
        return $stmt->fetch();
    }

    function getStoryAuthor($storyId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT username 
            FROM story NATURAL JOIN user 
            WHERE storyId = ?'
        );
        $stmt->execute(array($storyId));
        return $stmt->fetch()['username'];
    }

    function getStoryComments($storyId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT *
            FROM comment
            WHERE storyId = ? AND referencedComment IS NULL'
        );
        $stmt->execute(array($storyId));
        return $stmt->fetchAll();
    }

    function countStoryComments($storyId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT count(*) AS nrComments
            FROM comment
            WHERE storyId = ?'
        );
        $stmt->execute(array($storyId));
        return $stmt->fetch()['nrComments'];
    }

    function getStoryLikes($storyId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT SUM(vote) as likes
            FROM votesStory
            WHERE storyId = ? AND vote > 0'
        );
        $stmt->execute(array($storyId));

        $result = $stmt->fetch()['likes'];
        if ($result != null)
            return $result;
        else
            return 0;
    }

    function getStoryDislikes($storyId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT SUM(vote) as dislikes
            FROM votesStory
            WHERE storyId = ? AND vote < 0'
        );
        $stmt->execute(array($storyId));
        
        $result = $stmt->fetch()['dislikes'];
        if ($result != null)
            return $result;
        else
            return 0;
    }

    function userVotedStory($storyId, $username) {
        $db = Database::instance()->db();

        $userId = getUserId($username);

        $stmt = $db->prepare(
            'SELECT *
            FROM votesStory 
            WHERE storyId = ? AND userId = ?'
        );
        $stmt->execute(array($storyId, $userId));

        return $stmt->fetchAll() ? true : false;
    }

    function getUserVote($storyId, $username) {
        if (userVotedStory($storyId, $username)) {
            $db = Database::instance()->db();
            $stmt = $db->prepare(
                'SELECT vote 
                FROM votesStory 
                WHERE storyId = ? AND userId = ?'
            );
            $stmt->execute(array($storyId, $username));
            return $stmt->fetch()['vote'];
        }
        return null;
    }

    function updateStoryVote($storyId, $username, $vote) {
        if (userVotedStory($storyId,$username)) {
            if ($vote == 1)
                upvoteStory($storyId, $username); 
            else if ($vote == -1) 
                downvoteStory($storyId, $username);
        } else {
            addUserVote($storyId,$username,$vote);
        }
        
        $db = Database::instance()->db();
        $updateStmt = $db->prepare(
            'UPDATE story
            SET likes = ?, dislikes = ?
            WHERE storyId = ?'
        );
        $updateStmt->execute(array(
            getStoryLikes($storyId),
            -getStoryDislikes($storyId),
            $storyId)
        );
    }

    function upvoteStory($storyId, $username) {
        $db = Database::instance()->db();

        $userId = getUserId($username);

        $stmt = $db->prepare(
            'UPDATE votesStory 
            SET vote = ?
            WHERE userId = ? AND storyId = ?'
        );
        $stmt->execute(array(1,$userId,$storyId));
    }

    function downvoteStory($storyId, $username) {
        $db = Database::instance()->db();

        $userId = getUserId($username);

        $stmt = $db->prepare(
            'UPDATE votesStory 
            SET vote = ?
            WHERE userId = ? AND storyId = ?'
        );
        $stmt->execute(array(-1,$userId,$storyId));
    }
?>