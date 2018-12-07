<?php
    include_once('../includes/database.php');

    function createChannel($username,$channelTitle) {
        $db = Database::instance()->db();
        $userId = getUserId($username);
        $stmt = $db->prepare('INSERT INTO channel VALUES(?,?,?)');
        $stmt->execute(array($channelId,$userId,$channelTitle));
    }

    function getChannelTitle($channelId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT title FROM channel WHERE channelId = ?');
        $stmt->execute(array($channelId));
        return $stmt->fetch()['title'];
    }

    function getChannelStories($channelId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT * 
            FROM channel JOIN story USING(channelId)
            WHERE channelId = ?'
        );
        $stmt->execute(array($channelId));
        return $stmt->fetchAll();
    }
?>