<?php
    include_once('../includes/database.php');

    function get_story($story_id) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM story WHERE id = ?');
        $stmt->execute(array($story_id));
        return $stmt->fetchAll()[0];
    }

    function add_story($title, $fulltext, $userId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO story VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($title,date("Y/m/d"),$userId,$fulltext,0,0,""));
    }

    function user_voted_story($story_id, $username) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM votesStory WHERE story = ? AND user = ?');
        $stmt->execute(array($story_id, $username));
        return $stmt->fetchAll() ? true : false;
    }

    function update_story_votes($story_id, $vote) {
        if ($vote == 1) 
            upvote_story($story_id);
        else if ($vote == -1)
            downvote_story($story_id);
    }

    function upvote_story($story_id) {
        $db = Database::instance()->db();

        $likes = get_story($story_id)['likes'];
        
        $stmt = $db->prepare('UPDATE story SET likes = ? WHERE id = ?');
        $stmt->execute(array(++$likes, $story_id));
    }

    function downvote_story($story_id) {
        $db = Database::instance()->db();

        $dislikes = get_story($story_id)['dislikes'];
        
        $stmt = $db->prepare('UPDATE story SET dislikes = ? WHERE id = ?');
        $stmt->execute(array(++$dislikes, $story_id));
    }
?>