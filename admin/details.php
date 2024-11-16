<?php
session_start();
if(!isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {
    header("location:index.php");
    exit();
}
include "../classes/Database.php";
include "../classes/MediaItem.php";
$config = include "../util/dsn.php";

$db = new Database($config);
$id = $_GET["id"];
$item = new MediaItem();
$item->loadMediaItem($id,$db);


?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli Media</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 2rem;
        }

        .details-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 800px;
        }

        .details-container h1 {
            text-align: center;
            margin-bottom: 2rem;
        }

        .details-list {
            list-style: none;
            padding: 0;
        }

        .details-list li {
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .details-list li span:first-child {
            font-weight: bold;
            margin-right: 1rem;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }

        .button-container a {
            width: 48%;
        }
    </style>
</head>
<body>
<div class="details-container">
    <h1>Dettagli Media</h1>
    <ul class="details-list">
        <li>
            <span>ID:</span>
            <span>
                <?= htmlspecialchars($item->getId()); ?>
                <a href="delete.php?id=<?= htmlspecialchars($item->getId()); ?>" class="btn btn-danger btn-sm ms-3">Elimina</a>
            </span>
        </li>
        <li>
            <span>Titolo:</span>
            <span><?= htmlspecialchars($item->getTitle()); ?></span>
        </li>
        <li>
            <span>Autore:</span>
            <span><?= htmlspecialchars($item->getAuthor()); ?></span>
        </li>
        <li>
            <span>Tipo di Media:</span>
            <span><?= htmlspecialchars($item->getMediaType()); ?></span>
        </li>
        <li>
            <span>Descrizione:</span>
            <span><?= htmlspecialchars($item->getDescription()); ?></span>
        </li>

        <?php if ($item->getMediaType() === 'video'): ?>
            <li>
                <span>Stagioni Totali:</span>
                <span><?= htmlspecialchars($item->getStagioniTotali()); ?></span>
            </li>
            <li>
                <span>Episodi Totali:</span>
                <span><?= htmlspecialchars($item->getEpisodiTotali()); ?></span>
            </li>
        <?php elseif ($item->getMediaType() === 'book'): ?>
            <li>
                <span>Volumi Totali:</span>
                <span><?= htmlspecialchars($item->getVolumiTotali()); ?></span>
            </li>
            <li>
                <span>Capitoli Totali:</span>
                <span><?= htmlspecialchars($item->getEpisodiTotali()); ?></span>
            </li>
        <?php endif; ?>
    </ul>

    <div class="button-container">
        <a href="update.php?id=<?= htmlspecialchars($item->getId()); ?>" class="btn btn-primary">Modifica</a>
        <a href="delete.php?id=<?= htmlspecialchars($item->getId()); ?>" class="btn btn-danger">Elimina</a>
    </div>
</div>
</body>
</html>
