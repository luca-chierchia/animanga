<?php
require_once '../classes/User.php';
require_once '../classes/MediaItem.php';
require_once '../classes/Database.php';
include '../util/functions.php';
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

$arr2 = $user->getMediaItem();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['increment'], $_POST['media_item_id'])) {
    $mediaItemId = intval($_POST['media_item_id']);
    $item = new MediaItem();
    $item = $item->loadMediaItem($mediaItemId, $db);
    $type = $_POST['type'];
    if ($type === 'episode') {
        $user->incrementEpisodes($item, $db); // Incrementa gli episodi
    } elseif ($type === 'chapter') {
        $user->incrementChapter($item, $db); // Incrementa i capitoli
    }

    // Ricarica la pagina per aggiornare i dati
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
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
                    <th>Episodi Visti</th>
                    <th>Episodi Totali</th>
                    <th>ID</th>
                    <th>Episodi+</th>
                    <th>Unfollow</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tvSeries as $tv) : ?>
                    <tr>
                        <?php  ?>
                        <td><?= htmlspecialchars($tv->getTitle()); ?></td>
                        <td><?= htmlspecialchars($tv->getAuthor()); ?></td>
                        <td>  <?php
                            // Trova il progresso degli episodi visti per il media corrente
                            $episodesWatched = 0; // Valore di default
                            foreach ($arr2 as $progress) {
                                if ($progress['media_item_id'] == $tv->getId()) {
                                    $episodesWatched = htmlspecialchars($progress['episodes_watched']);
                                    break;
                                }
                            }
                            echo $episodesWatched;
                            ?></td>
                        <td><?= htmlspecialchars($tv->getEpisodiTotali()); ?></td>
                        <td><?= htmlspecialchars($tv->getId()) ?></td>
                        <td>
                            <!-- Incrementa Episodi -->
                            <form method="POST" class="d-inline">
                                <input type="hidden" name="media_item_id" value="<?= htmlspecialchars($tv->getId()) ?>">
                                <input type="hidden" name="type" value="episode">
                                <button type="submit" name="increment" class="btn btn-success btn-sm">+1 Episodio</button>
                            </form>
                        </td>
                        <td> <form action="unfollow.php" method="POST" class="d-inline">
                                <input type="hidden" name="media_item_id" value="<?= htmlspecialchars($tv->getId()) ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Unfollow</button>
                            </form></td>
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
                    <th>Capitoli+</th>
                    <th>Unfollow</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($manga as $m) : ?>
                    <tr>
                        <td><?= htmlspecialchars($m->getTitle()); ?></td>
                        <td><?= htmlspecialchars($m->getAuthor()); ?></td>
                        <td>
                            <?php
                            // Trova il progresso degli episodi visti per il media corrente
                            $chaptersRead = 0; // Valore di default
                            foreach ($arr2 as $progress) {
                                if ($progress['media_item_id'] == $m->getId()) {
                                    $chaptersRead = htmlspecialchars($progress['chapters_read']);
                                    break;
                                }
                            }
                            echo $chaptersRead;
                            ?>

                        </td>
                        <td><?= htmlspecialchars($m->getCapitoliTotali()); ?></td>
                        <td><?= htmlspecialchars($m->getId()); ?></td>
                        <td>
                            <!-- Incrementa Capitoli -->
                            <form method="POST" class="d-inline">
                                <input type="hidden" name="media_item_id" value="<?= htmlspecialchars($m->getId()) ?>">
                                <input type="hidden" name="type" value="chapter">
                                <button type="submit" name="increment" class="btn btn-success btn-sm">+1 Capitolo</button>
                            </form>
                        </td>
                        <td> <form action="unfollow.php" method="POST" class="d-inline">
                                <input type="hidden" name="media_item_id" value="<?= htmlspecialchars($m->getId()) ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Unfollow</button>
                            </form></td>
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



