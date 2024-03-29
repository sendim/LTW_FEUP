<?php
include_once '../includes/session.php';
include_once '../includes/database.php';
include_once '../database/db_story.php';
include_once '../database/db_user.php';
include_once '../database/db_channel.php';
include_once '../includes/database.php';

$db = Database::instance()->db();

$username = $_SESSION['username'];
$title = $_POST['title'];
$text = $_POST['text'];
$channel = $_POST['channel'];
$csrf = $_GET['csrf'];

if ($_SESSION['csrf'] != $csrf) {
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
}

// get user id
$userId = getUserId($username);

// get channel id
$channelId = getChannelId($channel);

// remove all disallowed characters
$title = preg_replace('/[^a-zA-Z\s]/', '', $title);
if ($title == '') {
    $_SESSION['error_messages'][] = "Story title can only contain letters!";
    die(header('Location: ../pages/newStory.php'));
}

$text = preg_replace('/[^a-zA-Z0-9]/', '', $text);
if ($text == '') {
    $_SESSION['error_messages'][] = "Story description can only contain letters and numbers!";
    die(header('Location: ../pages/newStory.php'));
}

try {
    // add new story
    $storyId = addStory($title, $text, $userId, $channelId);

    // story uploaded img
    $img = $_FILES['image']['tmp_name'];

    if ($img) {

        // insert image data into database
        $stmt = $db->prepare('INSERT INTO images VALUES(NULL,?,?,?)');
        $stmt->execute(array($userId, $storyId, $title));

        // get image ID
        $id = $db->lastInsertId();

        // generate filenames for original, thumbnail and icon picture files
        $originalFilename = "../images/originals/$id.jpg";
        $thumbnailFilename = "../images/thumbnails/$id.jpg";

        // move the uploaded file to its final destination
        move_uploaded_file($img, $originalFilename);

        // create an image representation of the original image
        $original = imagecreatefromjpeg($originalFilename);

        $width = imagesx($original); // width of the original image
        $height = imagesy($original); // height of the original image

        // Calculate width and height of medium sized image (max width: 400)
        $thumbnailWidth = $width;
        $thumbnailheight = $height;
        if ($thumbnailWidth > 400) {
            $thumbnailWidth = 400;
            $thumbnailheight = $thumbnailheight * ($thumbnailWidth / $width);
        }

        // Create and save a medium image
        $thumbnail = imagecreatetruecolor($thumbnailWidth, $thumbnailheight);
        imagecopyresized(
            $thumbnail, $original, 0, 0,
            0, 0, $thumbnailWidth, $thumbnailheight,
            $width, $height
        );
        imagejpeg($thumbnail, $thumbnailFilename);
    }

    // redirect to created story page
    header('Location: ../pages/story.php?id=' . $storyId);

} catch (PDOException $e) {
    // redirect to last page showing error
    $_SESSION['error_messages'][] = "Failed creating new story";
    header('Location: ../pages/newStory.php');
}
