<?php
require_once '../classes/User.php';
require_once '../classes/MediaItem.php';
require_once '../classes/Database.php';
$config = include "../util/dsn.php";
session_start();

if(!isset($_SESSION["username"])){
    header("Location: ../index.php");
    exit();
}
$db = new Database($config);
$user = $_SESSION['user'];
$arrOfMediaItems = [];
$arr = $user->getMediaItem();



foreach ($arr as $item) {
    $items = new MediaItem();
    $items = $items->loadMediaItem($item['media_item_id'],$db);
    if($items) {
        $arrOfMediaItems[] = $items;
    }
}

$tvSeries = [];
$manga = [];

foreach ($arrOfMediaItems as $item) {
    if($item->getMediaType() === "video")
        $tvSeries[] = $item;
    elseif($item->getMediaType() === "book")
        $manga[] = $item;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Items</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h1 class="text-center">Media Items</h1>

    <!-- Serie TV Section -->
    <div class="my-4">
        <h2>Serie TV</h2>
        <?php if (empty($tvSeries)) : ?>
            <p class="text-muted">Nessuna serie TV trovata.</p>
        <?php else : ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Titolo</th>
                    <th>Autore</th>
                    <th>Episodi visti</th>
                    <th>Episodi Totali</th>
                    <th>ID</th>
                    <th>Unfollow</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tvSeries as $tv) : ?>
                    <tr>
                        <td><?= htmlspecialchars($tv->getTitle()); ?></td>
                        <td><?= htmlspecialchars($tv->getAuthor()); ?></td>
                        <td>Ep visti</td>
                        <td><?= htmlspecialchars($tv->getEpisodiTotali()); ?></td>
                        <td><?= htmlspecialchars($tv->getId()) ?></td>
                        <td>Tasto unfollow coming soon</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- Manga Section -->
    <div class="my-4">
        <h2>Manga</h2>
        <?php if (empty($manga)) : ?>
            <p class="text-muted">Nessun manga trovato.</p>
        <?php else : ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Titolo</th>
                    <th>Autore</th>
                    <th>Capitoli Letti</th>
                    <th>Capitoli Totali</th>
                    <th>ID:</th>
                    <th>Unfollow</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($manga as $m) : ?>
                    <tr>
                        <td><?= htmlspecialchars($m->getTitle()); ?></td>
                        <td><?= htmlspecialchars($m->getAuthor()); ?></td>
                        <td>Cap letti</td>
                        <td><?= htmlspecialchars($m->getCapitoliTotali()); ?></td>
                        <td><?= htmlspecialchars($m->getId()); ?></td>
                        <td>Tasto unfollow coming soon</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <a href="../index.php">
        <button type="button">Torna alla Home</button>
    </a>
</div>


</body>
</body>
</html>



