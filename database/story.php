<?php
    include_once('../includes/session.php');
    include_once('../includes/database.php');

    function add_story($title, $fulltext, $userId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO story VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($title,date("Y/m/d"),$userId,$fulltext,0,0,""));
    }

    function add_user_vote($story_id, $username, $vote) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO votesStory VALUES(?,?,?)');
        $stmt->execute(array($username, $story_id, $vote));
    }

    function get_story($story_id) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM story WHERE id = ?');
        $stmt->execute(array($story_id));
        return $stmt->fetchAll()[0];
    }

    function get_story_likes($story_id) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT SUM(vote) as likes
            FROM votesStory
            WHERE story = ? AND vote > 0'
        );
        $stmt->execute(array($story_id));

        $result = $stmt->fetchAll()[0]['likes'];
        if ($result != null)
            return $result;
        else
            return 0;
    }

    function get_story_dislikes($story_id) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT SUM(vote) as dislikes
            FROM votesStory
            WHERE story = ? AND vote < 0'
        );
        $stmt->execute(array($story_id));
        
        $result = $stmt->fetchAll()[0]['dislikes'];
        if ($result != null)
            return $result;
        else
            return 0;
    }

    function user_voted_story($story_id, $username) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT *
            FROM votesStory 
            WHERE story = ? AND user = ?'
        );
        $stmt->execute(array($story_id, $username));
        return $stmt->fetchAll() ? true : false;
    }

    function get_user_vote($story_id, $username) {
        if (user_voted_story($story_id, $username)) {
            $db = Database::instance()->db();
            $stmt = $db->prepare(
                'SELECT vote 
                FROM votesStory 
                WHERE story = ? AND user = ?'
            );
            $stmt->execute(array($story_id, $username));
            return $stmt->fetchAll()[0]['vote'];
        }
        return null;
    }

    function update_story_votes($story_id, $username, $vote) {
        if (user_voted_story($story_id,$username)) {
            if ($vote == 1)
                upvote_story($story_id, $username); 
            else if ($vote == -1) 
                downvote_story($story_id, $username);
        } else {
            add_user_vote($story_id,$username,$vote);
        }
    }

    function upvote_story($story_id, $username) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'UPDATE votesStory 
            SET vote = ?
            WHERE user = ? 
            AND story = ?'
        );
        $stmt->execute(array(1,$username,$story_id));
    }

    function downvote_story($story_id, $username) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'UPDATE votesStory 
            SET vote = ?
            WHERE user = ? AND story = ?'
        );
        $stmt->execute(array(-1,$username,$story_id));
    }
?>