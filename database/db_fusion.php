<?php
    include_once('../includes/database.php');

    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }

    function get_feed() {
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

    function add_story($title, $fulltext, $userId) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO story VALUES (NULL, ?, ?, ?, ?, ?)');
        $stmt->execute(array($title,date("Y/m/d"),$userId,$fulltext,0,""));
    }

    function user_login($username,$password) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM user WHERE username = ? AND password = ?');
        $stmt->execute(array($username,sha1($password)));
        return $stmt->fetch() !== false;
    }

    function get_profile($username) {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
        $stmt->execute(array($username));
        return $stmt->fetchAll();
    }

    function list_users() {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM user');
        $stmt->execute();
        return $stmt->fetchAll();
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
?>
