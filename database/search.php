<?php
    include_once('../includes/database.php');

    function get_feed() {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT story.*, user.*, COUNT(comment.id) AS comment
            FROM story JOIN user USING (username) 
            LEFT JOIN comment ON comment.storyId = story.id
            GROUP BY story.id, user.username
            ORDER BY published DESC'
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function get_channels() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM channel' );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function get_profiles() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM user');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function get_users() {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM user');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function get_stories() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM story');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function get_comments() {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM comment' );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function searchChannels($substring) {
        $channels = get_channels();
        $channelsSub = array();
        foreach($channels as $channel) {
            if (strpos($channel['title'], $substring) !== false) {
                $channelsSub[] = $channel;
            }
        }
        return $channelsSub;
    }

    function searchProfiles($substring) {
        $profiles = get_profiles();
        $profilesSub = array();
        foreach($profiles as $profile) {
            if (strpos($profile['name'], $substring) !== false) {
                $profilesSub[] = $profile;
            }
        }
        return $profilesSub;
    }

    function searchStory($substring) {
        $stories = get_stories();
        $storiesSub = array();
        foreach($stories as $story) {
            if (strpos($story['title'], $substring) !== false) {
                $storiesSub[] = $story;
            }
            else if (strpos($story['text'], $substring) !== false){
                $storiesSub[] = $story;
            }
        }
        return $storiesSub;
    }

    function searchComments($substring) {
        $comments = get_comments();
        $commentsSub = array();
        foreach($comments as $comment) {
            if (strpos($comment['text'], $substring) !== false) {
                $commentsSub[] = $comments;
            }
        }
        return $commentsSub;
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