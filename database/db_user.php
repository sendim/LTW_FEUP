<?php
    include_once('../includes/database.php');

    function userLogin($username,$password) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT * 
            FROM user 
            WHERE username = ?'
        );
        $stmt->execute(array($username));
        $user = $stmt->fetch();

        return $user !== false && password_verify($password,$user['password']);
    }

    function insertUser($username,$password,$name,$description) {
        $db = Database::instance()->db();

        $options = ['cost' => 12]; // hash length
        $hashedPwd = password_hash($password,PASSWORD_DEFAULT,$options);

        $stmt = $db->prepare('INSERT INTO user VALUES(NULL,?,?,?,?,0)');
        $stmt->execute(array($username,$hashedPwd,$name,$description));
    }

    function deleteUserById($id) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('DELETE FROM user WHERE userId = ?');
        $stmt->execute(array($id));
    }

    function deleteUserByUsername($username) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('DELETE FROM user WHERE username = ?');
        $stmt->execute(array($username));
    }

    function getUserId($username) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT userId FROM user WHERE username = ?');
        $stmt->execute(array($username));
        return $stmt->fetch()['userId'];
    }

    function getUserUsername($userId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT username FROM user WHERE userId = ?');
        $stmt->execute(array($userId));
        return $stmt->fetch()['username'];
    }

    function getUserProfile($username) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT username,name,description,points 
            FROM user 
            WHERE username = ?'
        );
        $stmt->execute(array($username));
        return $stmt->fetch();
    }

    function getUserProfilePhoto($username) {
        $db = Database::instance()->db();

        $stmt = $db->prepare(
            "SELECT * 
            FROM user NATURAL JOIN images
            WHERE username = ? AND title = 'profile'"
        );
        $stmt->execute(array($username));
        return $stmt->fetch();
    }

    function getUserPoints($username) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT points 
            FROM user 
            WHERE username = ?'
        );
        $stmt->execute(array($username));
        return $stmt->fetch()['points'];
    }

    function getUserStories($username) {
        $db = Database::instance()->db();

        $stmt = $db->prepare(
            'SELECT * 
            FROM story NATURAL JOIN user
            WHERE username = ?'
        );
        $stmt->execute(array($username));
        return $stmt->fetchAll();
    }

    function getUserComments($username) {
        $db = Database::instance()->db();

        $stmt = $db->prepare(
            'SELECT *
            FROM comment NATURAL JOIN user
            WHERE username = ?'
        );
        $stmt->execute(array($username));
        return $stmt->fetchAll();
    }

    function updateUserName($username,$name) {
        $db = Database::instance()->db();

        $stmt = $db->prepare(
            'UPDATE user
            SET name = ?
            WHERE username LIKE ?'
        );
        $stmt->execute(array($name,$username));
    }

    function updateUserUsername($username,$newUsername) {
        $db = Database::instance()->db();
        
        $stmt = $db->prepare(
            'UPDATE user
            SET username = ?
            WHERE username LIKE ?'
        );
        $stmt->execute(array($newUsername,$username));
    }

    function updateUserPassword($username,$password) {
        $db = Database::instance()->db();

        $options = ['cost' => 12]; // hash length
        $hashedPwd = password_hash($password,PASSWORD_DEFAULT,$options);

        $stmt = $db->prepare(
            'UPDATE user
            SET password = ?
            WHERE username LIKE ?'
        );
        $stmt->execute(array($hashedPwd ,$username));
    }

    function updateUserDescription($username,$description) {
        $db = Database::instance()->db();

        $stmt = $db->prepare(
            'UPDATE user
            SET description = ?
            WHERE username LIKE ?'
        );
        $stmt->execute(array($description,$username));
    }

    function updateUserPoints($username) {
        $storyPoints = 0;
        $commentsPoints = 0;

        $db = Database::instance()->db();

        // get points from user stories votes
        $storiesStmt = $db->prepare(
            'SELECT SUM(likes) - SUM(dislikes) AS storyPoints
            FROM story NATURAL JOIN user
            WHERE username LIKE ?'
        );
        $storiesStmt->execute(array($username));
        $storiesRes = $storiesStmt->fetch();
        if ($storiesRes != null) 
            $storyPoints = $storiesRes['storyPoints'];

        // get points from user comments votes
        $commentsStmt = $db->prepare(
            'SELECT SUM(likes) - SUM(dislikes) AS commentPoints
            FROM comment NATURAL JOIN user
            WHERE username LIKE ?'
        );
        $commentsStmt->execute(array($username));
        $commentsRes = $commentsStmt->fetch();
        if ($commentsRes != null) 
            $commentsPoints = $commentsRes['commentPoints'];

        $finalPoints = $storyPoints + $commentsPoints;
        $updateStmt = $db->prepare(
            'UPDATE user
            SET points = ?
            WHERE username = ?'
        );
        $updateStmt->execute(array($finalPoints,$username));
    }
?>