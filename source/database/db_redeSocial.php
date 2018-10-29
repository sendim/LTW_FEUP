<?php
    include_once('database/connection.php');

    function getFeed() {

        global $db;
        $stmt = $db->prepare('SELECT story.*, users.*, COUNT(comments.id) AS comments
        FROM story JOIN
             users USING (username) LEFT JOIN
             comments ON comments.news_id = story.id
        GROUP BY story.id, users.username
        ORDER BY published DESC'
         );

        $stmt->execute();
        return $stmt->fetchAll();
    }

    function register($username,$password) {

        global $db;

        $stmt = $db->prepare('INSERT INTO users VALUES (NULL, ?, ?, ?)');
        $stmt->execute(array($username, $password, "",0));
    }

?>