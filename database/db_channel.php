<?php
    include_once('../includes/database.php');

    function getChannelTitle($channelId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT title FROM channel WHERE channelId = ?');
        $stmt->execute(array($channelId));
        return $stmt->fetch()['title'];
    }
?>