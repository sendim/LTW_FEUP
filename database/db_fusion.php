<?php
    include_once('../includes/database.php');

    function getFeed() {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT story.*, user.*, COUNT(comment.id) AS comment
        FROM story JOIN
             user USING (username) LEFT JOIN
             comment ON comment.storyId = story.id
        GROUP BY story.id, user.username
        ORDER BY published DESC'
         );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function action_signup($username, $password) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO user VALUES (NULL, ?, ?, ?)');
        $stmt->execute(array($username, $password, "",0));
    }

    function action_add_story($title, $fulltext, $userId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO story VALUES (NULL, ?, ?, ?, ?, ?)');
        $stmt->execute(array($title, date("Y/m/d"), $userId,  $fulltext, 0, ""));
    }

    /*function action_signup($username, $password) {
        $stmt->execute(array($username, sha1($password)));
        return $stmt->fetch()?true:false; // return true if a line exists
    }*/

    function get_profile($username) {
        global $db;

        $stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
        $stmt->execute(array($username));
        return $stmt->fetchAll();
    }

    function delete_user($username) {
        global $db;

        $stmt = $db->prepare('DELETE FROM user WHERE username = ?');
        $stmt->execute(array($username));
    }
?>
