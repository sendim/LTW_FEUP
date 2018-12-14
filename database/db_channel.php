<?php
include_once '../includes/database.php';

function createChannel($username, $channelTitle)
{
    $db = Database::instance()->db();

    if (existsChannel($channelTitle)) {
        return false;
    }

    $userId = getUserId($username);
    $channelId = getChannelId($username);

    $stmt = $db->prepare('INSERT INTO channel VALUES(?,?,?)');
    $ret = $stmt->execute(array($channelId, $userId, $channelTitle));

    return $ret !== false;
}

function existsChannel($channelTitle)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM channel WHERE title = ?');
    $stmt->execute(array($channelTitle));
    return $stmt->fetch() !== false;
}

function getChannelId($channelTitle)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT channelId FROM channel WHERE title = ?');
    $stmt->execute(array($channelTitle));
    return $stmt->fetch()['channelId'];
}

function getChannelTitle($channelId)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT title FROM channel WHERE channelId = ?');
    $stmt->execute(array($channelId));
    return $stmt->fetch()['title'];
}

function getChannelStories($channelId, $order = 'published', $sort = '')
{
    $db = Database::instance()->db();

    // order by case-insensitive titles
    if ($order == 'title') {
        $order = 'story.title';
        if ($sort == 'ASC') {
            $sort = 'COLLATE NOCASE ASC';
        } else if ($sort == 'DESC') {
            $sort = 'COLLATE NOCASE DESC';
        }
    }

    $query = sprintf(
        'SELECT *
        FROM channel JOIN story USING(channelId)
        WHERE channelId = %d
        ORDER BY %s %s',
        $channelId, $order, $sort
    );
    $stmt = $db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll();
}
