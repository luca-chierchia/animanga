<?php
include "classes/Database.php";
include 'classes/User.php';
include "classes/MediaItem.php";
include 'util/function.php';
$config = include 'util/dsn.php';

$db = new Database($config);

$user = User::loadByCredentials('Mario','potter21',$db);
$user2 = User::loadByCredentials('Ellech','1029dmkl',$db);







$arrMostFollowedSeries = mostFollowed('video',$db);
$arrOfItem = [];

foreach ($arrMostFollowedSeries as $mostFollowedSeries) {
    $item = new MediaItem($db,'media_items');
    $item->loadMediaItem($mostFollowedSeries['media_item_id']);
    $arrOfItem[] = $item;

}
var_dump($arrOfItem);





?>