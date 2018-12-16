<?php
include_once '../templates/tpl_layout.php';
include_once '../templates/tpl_auth.php';

// verify if user session is set
if (isset($_SESSION['username'])) {
    die(header('Location: feed.php'));
}

drawLayout(function () {
    drawLogin();
}, 'login');
