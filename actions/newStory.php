<?php
    include_once('../database/db_story.php');
    include_once('../database/db_user.php');

    $username = $_SESSION['username'];

    // get user id
    $userId = getUserId($username);

    $title = $_POST['title'];
    $text = $_POST['text'];

    ## TODO: ligar channel com a nova story
    ## $channel = $_POST['channel'];

    
    try {
        # creates story
        addStory($title, $text, $userId);

        ## TODO: redirect to story (not feed)
        header('Location: ../pages/feed');

    } catch (PDOException $e) {
        # TODO: redirect to new story page showing error
        $_SESSION['error_messages'][] = "Failed creating new story";

        header('Location: ../pages/newStory');
    }

?>