<?php
include 'classes/User.php';
$config = include 'util/dsn.php';

$db = new Database($config);

$user = User::loadByCredentials('Mario','potter21',$db);
$user2 = User::loadByCredentials('Ellech','1029dmkl',$db);
$mediaItem = new MediaItem($db,'media_items');
$mediaItem->loadMediaItem(6);
$user2->incrementChapter($mediaItem,$db);










?>