<?php
    session_start();

    function set_current_user($username) {
        $_SESSION['username'] = $username;
    }

    function get_error_messages() {
        if (isset($_SESSION['error_messages']))
          return $_SESSION['error_messages'];
        else
          return array();    
    }

    function get_success_messages() {
        if (isset($_SESSION['success_messages']))
          return $_SESSION['success_messages'];
        else
          return array();
    }

    function clear_messages() {
        unset($_SESSION['error_messages']);
        unset($_SESSION['success_messages']);
    }

    function generate_random_token() {
        return bin2hex(openssl_random_pseudo_bytes(32));
    }

    if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = generate_random_token();
    }
?>