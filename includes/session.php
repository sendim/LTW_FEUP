<?php
    session_start();

    function set_current_user($username) {
        $_SESSION['username'] = $username;
    }
?>