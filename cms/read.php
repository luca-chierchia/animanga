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

$item = new MediaItem();

$array = $item->readAll($db);

$mangaArray =[];
$SerieTvArray =[];

foreach ($array as $item) {
    if($item['media_type'] === 'book')
        array_push($mangaArray, $item);
    else
        array_push($SerieTvArray, $item);
}

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: space-between;
            width: 90%;
            max-width: 1200px;
            gap: 2rem;
        }

        .column {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            flex: 1;
            max-height: 500px; /* Altezza massima per lo scroll */
            overflow-y: auto; /* Scroll verticale */
            padding: 1rem;
        }

        .column h2 {
            text-align: center;
            margin-bottom: 1rem;
        }

        .media-item {
            padding: 0.5rem;
            border-bottom: 1px solid #ddd;
        }

        .media-item:last-child {
            border-bottom: none;
        }

        .media-item strong {
            display: block;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Colonna Serie TV -->
    <div class="column">
        <h2>Serie TV</h2>
        <?php if (!empty($SerieTvArray)): ?>
            <?php foreach ($SerieTvArray as $item): ?>
                <div class="media-item">
                    <strong><?= htmlspecialchars($item['title']); ?></strong>
                    <small>Autore: <?= htmlspecialchars($item['author']); ?></small>
                    <a href="../admin/details.php?id= <?= htmlspecialchars($item['media_item_id']); ?>">ID: <?= htmlspecialchars($item['media_item_id']); ?></a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nessuna Serie TV disponibile.</p>
        <?php endif; ?>
    </div>

    <!-- Colonna Manga -->
    <div class="column">
        <h2>Manga</h2>
        <?php if (!empty($mangaArray)): ?>
            <?php foreach ($mangaArray as $item): ?>
                <div class="media-item">
                    <strong><?= htmlspecialchars($item['title']); ?></strong>
                    <small>Autore: <?= htmlspecialchars($item['author']); ?></small>
                    <a href="../admin/details.php?id=<?= htmlspecialchars($item['media_item_id']); ?>">ID: <?= htmlspecialchars($item['media_item_id']); ?></a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nessun Manga disponibile.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>