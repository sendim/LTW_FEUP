<?php
    include_once('../includes/database.php');

    function user_login($username,$password) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM user WHERE username = ? AND password = ?');
        $stmt->execute(array($username,sha1($password)));
        return $stmt->fetch() !== false;
    }

    function insert_user($username,$password,$fullName,$description) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO user VALUES(?,?,?,?,0)');
        $stmt->execute(array($username,sha1($password),$fullName,$description));
    }

    function delete_user($username) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('DELETE FROM user WHERE username = ?');
        $stmt->execute(array($username));
    }

    function get_user_profile($username) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT username,name,description,points FROM user WHERE username = ?');
        $stmt->execute(array($username));
        return $stmt->fetchAll();
    }

    function get_user_profile_photo($username) {
        $db = Database::instance()->db();

        // retrieve users' most recent profile picture
        $stmt = $db->prepare(
            "SELECT * 
            FROM user NATURAL JOIN images 
            WHERE username LIKE ?
            AND title LIKE 'profile'"
        );
        $stmt->execute(array($username));
        return $stmt->fetch();
    }

    function get_user_stories($username) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM story WHERE username = ?');
        $stmt->execute(array($username));
        return $stmt->fetchAll();
    }

    function get_user_comments($username) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM comment WHERE username = ?');
        $stmt->execute(array($username));
        return $stmt->fetchAll();
    }

    function update_user_name($username,$name) {
        $db = Database::instance()->db();

        $stmt = $db->prepare(
            'UPDATE user
            SET name = ?
            WHERE username LIKE ?'
        );
        $stmt->execute(array($name,$username));
    }

    function update_user_username($username,$newUsername) {
        $db = Database::instance()->db();

        // TODO: use UPDATE ON CASCADE on username
        $stmt = $db->prepare(
            'UPDATE user
            SET username = ?
            WHERE username LIKE ?'
        );
        $stmt->execute(array($newUsername,$username));
    }

    function update_user_password($username,$password) {
        $db = Database::instance()->db();

        $stmt = $db->prepare(
            'UPDATE user
            SET password = ?
            WHERE username LIKE ?'
        );
        $stmt->execute(array(sha1($password),$username));
    }

    function update_user_description($username,$description) {
        $db = Database::instance()->db();

        $stmt = $db->prepare(
            'UPDATE user
            SET description = ?
            WHERE username LIKE ?'
        );
        $stmt->execute(array($description,$username));
    }

    function update_user_points($username) {
        $story_points = 0;
        $comments_points = 0;

        $db = Database::instance()->db();

        // get points from user stories votes
        $stories_stmt = $db->prepare(
            'SELECT SUM(likes) - SUM(dislikes) AS storyPoints
            FROM story
            WHERE username LIKE ?'
        );
        $stories_stmt->execute(array($username));
        $stories_res = $stories_stmt->fetchAll();
        if ($stories_res != null) 
            $story_points = $stories_res[0]['storyPoints'];

        // get points from user comments votes
        $comments_stmt = $db->prepare(
            'SELECT SUM(likes) - SUM(dislikes) AS commentPoints
            FROM comment
            WHERE username LIKE ?'
        );
        $comments_stmt->execute(array($username));
        $comments_res = $comments_stmt->fetchAll();
        if ($comments_res != null) 
            $comments_points = $comments_res[0]['commentPoints'];

        $final_points = $story_points + $comments_points;
        $update_stmt = $db->prepare(
            'UPDATE user
            SET points = ?
            WHERE username = ?'
        );
        $update_stmt->execute(array($final_points,$username));
    }
?>