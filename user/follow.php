<?php
include '../classes/User.php';
include '../classes/Database.php';
include '../classes/MediaItem.php';
$config = include '../util/dsn.php';
$db = new Database($config);
$item = new MediaItem();

session_start();

$user = $_SESSION['user'];




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ottieni il valore di media_item_id
    $mediaItemId = intval($_POST['media_item_id']);
    $followItem = $item->loadMediaItem($mediaItemId, $db);

    $user->followMediaItem($followItem, $db);
    header('Location: userDashboard.php');
    exit();
}
