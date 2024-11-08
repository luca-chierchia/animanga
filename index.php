<?php

include "classes/Dsn.php";
include "classes/Database.php";

$var = new Dsn('giacomino','localhost');
$db = new Database($var,'root','');