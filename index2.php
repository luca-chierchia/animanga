<?php
include "classes/Database.php";
include 'classes/User.php';
include "classes/MediaItem.php";
include 'util/function.php';
$config = include 'util/dsn.php';

$arr = [
    "title"         => "titol",
    "description"   => "descrizio pova",
    "author"        => "autore di pra",
    "media_type"    => "book",
    "release_date"  => date("Y-m-d"),
    "stagioni_totali" => 1,
    "episodi_totali" => 24,
    "capitoli_totali"=> 1,
    "volumi_totali" => 2,
];

$db = new Database($config);

$item = new MediaItem();

if($item->create($arr,$db))
    echo "Record inserito con successo";
else
    "Errore inserimento record";



?>