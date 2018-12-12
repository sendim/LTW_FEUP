<?php
    include_once('../includes/database.php');

    function createChannel($username,$channelTitle) {
        $db = Database::instance()->db();

        if (existsChannel($channelTitle)) 
            return false;

        $userId = getUserId($username);
        $channelId = getChannelId($username);
        
        $stmt = $db->prepare('INSERT INTO channel VALUES(?,?,?)');
        $ret = $stmt->execute(array($channelId,$userId,$channelTitle));

        return $ret !== false;
    }

    function existsChannel($channelTitle) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM channel WHERE title = ?');
        $stmt->execute(array($channelTitle));
        return $stmt->fetch() !== false;
    }

    function getChannelId($channelTitle) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT channelId FROM channel WHERE title = ?');
        $stmt->execute(array($channelTitle));
        return $stmt->fetch()['channelId'];
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