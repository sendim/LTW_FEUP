<?php
    include_once('../includes/session.php');
    include_once('../includes/database.php');

    function addStory($title, $text, $userId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO story VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($title,date("Y/m/d"),$userId,$text,0,0,""));
    }

    function addUserVote($storyId, $username, $vote) {
        $db = Database::instance()->db();
        $userId = getUserId($username);
        $stmt = $db->prepare('INSERT INTO votesStory VALUES(?,?,?)');
        $stmt->execute(array($userId, $storyId, $vote));
    }

    function getStory($storyId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM story WHERE storyId = ?');
        $stmt->execute(array($storyId));
        return $stmt->fetchAll()[0];
    }

    function getAuthor($storyId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT username 
            FROM story NATURAL JOIN user 
            WHERE storyId = ?'
        );
        $stmt->execute(array($storyId));
        return $stmt->fetchAll()[0]['username'];
    }

    function getStoryLikes($storyId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT SUM(vote) as likes
            FROM votesStory
            WHERE storyId = ? AND vote > 0'
        );
        $stmt->execute(array($storyId));

        $result = $stmt->fetchAll()[0]['likes'];
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
        
        $result = $stmt->fetchAll()[0]['dislikes'];
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
            return $stmt->fetchAll()[0]['vote'];
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