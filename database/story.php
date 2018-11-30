<?php
    include_once('../includes/database.php');

    function add_story($title, $fulltext, $userId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO story VALUES (NULL, ?, ?, ?, ?, ?)');
        $stmt->execute(array($title,date("Y/m/d"),$userId,$fulltext,0,""));
    }

?>