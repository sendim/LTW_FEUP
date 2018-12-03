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
?>