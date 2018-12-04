<?php
    include_once('../includes/session.php');
    include_once('../database/user.php');
    
    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));

    $username = $_SESSION['username'];

    // process each post variable
    $inputs = array('name','username','password','description');

    foreach($inputs as $input)
        if (!empty($_POST[$input])) {
            switch($input) {
                case 'name':
                    update_user_name($username,$_POST['name']);
                    break;
                case 'username':
                    // TODO: update foreign key on username to be able to update it
                    //update_user_username($username,$_POST['username']);
                    break;
                case 'password':
                    update_user_password($username,$_POST['password']);
                    break;
                case 'description':
                    update_user_description($username,$_POST['description']);
                    break;
            }
        }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>