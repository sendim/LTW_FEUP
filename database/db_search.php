<?php
    include_once('../includes/database.php');

    function getUsers() {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM user');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getStories() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM story');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getComments() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM comment');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getChannels() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM channel');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getFeed() {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT story.*, user.*, COUNT(comment.commentId) AS nrComments
            FROM story NATURAL JOIN user LEFT JOIN comment ON comment.storyId = story.storyId
            GROUP BY story.storyId, user.username
            ORDER BY published DESC'
        ); 
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function searchProfiles($substring) {
        $db = Database::instance()->db();
        $stmt = $db->prepare("SELECT * FROM user WHERE username LIKE '%$substring%'");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function searchStory($substring) {
        $db = Database::instance()->db();

        $stmt = $db->prepare("SELECT * FROM story WHERE title LIKE '%$substring%' ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function searchComments($substring) {
        $db = Database::instance()->db();

        $stmt = $db->prepare("SELECT * FROM comment WHERE text LIKE '%$substring%' ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    function searchBySubstrings($substring, $array) {
        $obj = array();
        foreach($array as $object) {
            if (strpos($object, $substring) !== false) {
                $obj[] = $object;
            }
        }
        return $obj;
    }

?>
