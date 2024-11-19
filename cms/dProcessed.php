<?php
include '../classes/MediaItem.php';
include '../classes/Database.php';

session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;
    $confirm = isset($_POST['confirm']) ? $_POST['confirm'] : null;

    if (!$id) {
        echo "Errore: ID non valido.";
        exit;
    }

    if ($confirm === 'yes') {
        $item = new MediaItem();
        $db = new Database(require '../util/dsn.php');

        if ($item->delete($id, $db)) {
            $operazione = "confirmed";
            header('Location: statusOperation.php?operazione='.$operazione);
            exit;
        } else {
            echo "Errore durante l'eliminazione.";
        }
    } elseif ($confirm === 'no') {
        $operazione = "notConfirmed";
        header('Location: statusOperation.php?operazione='.$operazione );
        exit;
    } else {
        echo "Azione non valida.";
    }
}
?>
