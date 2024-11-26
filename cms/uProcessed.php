<?php

include '../classes/MediaItem.php';
include '../classes/Database.php';

session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $confirm = isset($_POST['confirm']) ? $_POST['confirm'] : null;
    $arr = [
        'title'          => $_POST['title'],
        'description'    => $_POST['description'],
        'author'         => $_POST['author'],
        'release_date'   => $_POST['release_date'],
        'stagioni_totali' => $_POST['stagioni_totali']?? '',
        'episodi_totali' => $_POST['episodi_totali']?? '',
        'volumi_totali' => $_POST['volumi_totali']?? '',
        'capitoli_totali' => $_POST['capitoli_totali']?? '',

    ];


    if ($confirm === 'yes') {
        $item = new MediaItem();
        $db = new Database(require '../util/dsn.php');

        var_dump($arr);
        if ($item->update($arr, $db)) {
            $operazione = "confirmed";
            header('Location: statusOperationUpdate.php?operazione=' . $operazione);
            exit;
        } else {
            echo "Errore durante l'eliminazione.";
        }
    } elseif ($confirm === 'no') {
        $operazione = "notConfirmed";
        header('Location: statusOperationUpdate.php?operazione=' . $operazione);
        exit;
    } else {
        echo "Azione non valida.";
    }
}

