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

    function getFeed($userId,$order='published',$sort='') {
        $db = Database::instance()->db();

        // order by case-insensitive titles
        if ($order == 'title') {
            if ($sort == 'ASC')
                $sort = 'COLLATE NOCASE ASC';
            else if ($sort == 'DESC')
                $sort = 'COLLATE NOCASE DESC';
        }

        $query = sprintf(
            'SELECT story.*, user.*, COUNT(comment.commentId) AS nrComments
            FROM story NATURAL JOIN user LEFT JOIN comment ON comment.storyId = story.storyId
            JOIN subscribed using(channelId) WHERE subscribed.userId = %d
            GROUP BY story.storyId, user.username
            ORDER BY %s %s',
            $userId, $order, $sort
        );
        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    function searchChannels($substring) {

        $db = Database::instance()->db();

        $stmt = $db->prepare("SELECT * FROM channel WHERE title LIKE '%$substring%' ");
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
