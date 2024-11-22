<?php
include 'classes/Database.php';
include 'classes/Search.php';
include 'classes/MediaItem.php';
$db = new Database(include 'util/dsn.php');
var_dump('pippo');
$test = Search::searchByNumOfCap($db,23);
echo "<pre>";
var_dump($test);
