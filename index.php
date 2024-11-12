<?php
include 'classes/User.php';
$config = include 'util/dsn.php';

$db = new Database($config);

$user = User::loadByCredentials('Mario','potter21',$db);
var_dump($user);
$item = new MediaItem($db,'media_items');
$item->loadMediaItem(6);
if($user->followMediaItems($item))
    echo"follow ". $item->getTitle()."\n";
else
    echo "è gia un media tra i tuoi seguiti";





/*
 * $arr = [
    'title'             => 'Bleach',
    'description'       => 'Bleach',
    'author'            => 'Mario',
    'media_type'        => 'video',
    'release_date'      => date('2016-08-10'),
    'stagioni_totali'   => 0,
    'episodi_totali'    => 0,
    'volumi_totali'     => 0,
    'capitoli_totali'   => 0,

];
$anime = new Anime($db, 'media_items');
$anime->create($arr);
 */

?>