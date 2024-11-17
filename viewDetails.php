<?php
session_start();

include "classes/Database.php";
include "classes/MediaItem.php";
$config = include "util/dsn.php";

$db = new Database($config);
$id = $_GET["id"];

// Validazione e Sanitizzazione dell'ID
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die('ID non valido');
}

$item = new MediaItem();
$item->loadMediaItem($id, $db);
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
            width: 40%; /* Aggiunto per migliorare l'allineamento */
        }

        .details-list li span:nth-child(2) {
            border: 2px solid transparent;
            padding: 0.5rem;
            border-radius: 5px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            width: 55%; /* Aggiunto per migliorare l'allineamento */
            word-wrap: break-word; /* Per gestire testi lunghi */
        }

        /* Effetto hover sul secondo <span> */
        .details-list li span:nth-child(2):hover {
            border-color: #007bff; /* Colore del bordo al passaggio del mouse */
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5); /* Ombra al passaggio del mouse */
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }

        .button-container a {
            width: 48%;
        }

        /* Miglioramento Responsività */
        @media (max-width: 576px) {
            .details-list li {
                flex-direction: column;
                align-items: flex-start;
            }

            .details-list li span:first-child,
            .details-list li span:nth-child(2) {
                width: 100%;
            }

            .button-container {
                flex-direction: column;
            }

            .button-container a {
                width: 100%;
                margin-bottom: 1rem;
            }
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
                <?= htmlspecialchars($item->getId(), ENT_QUOTES, 'UTF-8'); ?>
            </span>
        </li>
        <li>
            <span>Titolo:</span>
            <span><?= htmlspecialchars($item->getTitle(), ENT_QUOTES, 'UTF-8'); ?></span>
        </li>
        <li>
            <span>Autore:</span>
            <span><?= htmlspecialchars($item->getAuthor(), ENT_QUOTES, 'UTF-8'); ?></span>
        </li>
        <li>
            <span>Tipo di Media:</span>
            <span><?= htmlspecialchars($item->getMediaType(), ENT_QUOTES, 'UTF-8'); ?></span>
        </li>
        <li>
            <span>Descrizione:</span>
            <span><?= htmlspecialchars($item->getDescription(), ENT_QUOTES, 'UTF-8'); ?></span>
        </li>

        <?php if ($item->getMediaType() === 'video'): ?>
            <li>
                <span>Stagioni Totali:</span>
                <span><?= htmlspecialchars($item->getStagioniTotali(), ENT_QUOTES, 'UTF-8'); ?></span>
            </li>
            <li>
                <span>Episodi Totali:</span>
                <span><?= htmlspecialchars($item->getEpisodiTotali(), ENT_QUOTES, 'UTF-8'); ?></span>
            </li>
        <?php elseif ($item->getMediaType() === 'book'): ?>
            <li>
                <span>Volumi Totali:</span>
                <span><?= htmlspecialchars($item->getVolumiTotali(), ENT_QUOTES, 'UTF-8'); ?></span>
            </li>
            <li>
                <span>Capitoli Totali:</span>
                <span><?= htmlspecialchars($item->getEpisodiTotali(), ENT_QUOTES, 'UTF-8'); ?></span>
            </li>
        <?php endif; ?>
    </ul>

    <div class="button-container">
        <!-- Possibilità di follow da inserire qui -->
    </div>
</div>
</body>
</html>
