<?php
// Connessione al database
include "classes/Anime.php";

$arrDsn = [
    "host" => "localhost",
    "dbname" => "animanga",
    "user" => "root",
    "password" => "toor"
];

$arr = [
    "title"         => "Naruto",
    "description"   => "Naruto is manga and anime famous in the japan and world",
    "author"        => "Togashi Kishimimotomotura",
    "media_type"    => "book",
    "release_date"  => date("Y-m-d"),
    "stagioni_totali" => 0,
    "episodi_totali" => 0,
    "volumi_totali" => 15,
    "capitoli_totali" => 144
];

$dbh = new Anime(new Database($arrDsn), "media_items");
$dbh->getProgress();