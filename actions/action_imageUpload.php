<?php
include_once '../includes/session.php';
include_once '../includes/database.php';
include_once '../database/db_user.php';

$db = Database::instance()->db();

$username = $_SESSION['username'];
$userId = getUserId($username);
$title = $_POST['title'];

// delete previous profile picture if it's the case
if ($_POST['title'] == 'profile') {
    $deleteStmt = $db->prepare('DELETE FROM images WHERE userId = ? AND title = ?');
    $deleteStmt->execute(array($userId, $title));
}

// insert image data into database
$stmt = $db->prepare('INSERT INTO images VALUES(NULL,?,NULL,?)');
$stmt->execute(array($userId, $title));

// get image ID
$id = $db->lastInsertId();

// generate filenames for original, thumbnail and icon picture files
$originalFileName = "../images/originals/$id.jpg";
$thumbnailFileName = "../images/thumbnails/$id.jpg";
$iconFileName = "../images/icons/$id.jpg";

// move the uploaded file to its final destination
move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);

// create an image representation of the original image
$original = imagecreatefromjpeg($originalFileName);

$width = imagesx($original); // width of the original image
$height = imagesy($original); // height of the original image
$square = min($width, $height); // size length of the maximum square

// create and save a square thumbnail
$thumbnail = imagecreatetruecolor(150, 150);
imagecopyresized(
    $thumbnail, $original, 0, 0,
    ($width > $square) ? ($width - $square) / 2 : 0,
    ($height > $square) ? ($height - $square) / 2 : 0,
    150, 150, $square, $square
);
imagejpeg($thumbnail, $thumbnailFileName);

// create and save a small icon
$icon = imagecreatetruecolor(30, 30);
imagecopyresized(
    $icon, $original, 0, 0,
    ($width > $square) ? ($width - $square) / 2 : 0,
    ($height > $square) ? ($height - $square) / 2 : 0,
    30, 30, $square, $square
);
imagejpeg($icon, $iconFileName);

header('Location: ' . $_SERVER['HTTP_REFERER']);
