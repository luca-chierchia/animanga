<?php
include 'classes/User.php';
include 'includes/header.php';
include 'classes/Database.php';
include 'classes/MediaItem.php';
include 'util/function.php';

$db = new Database(include 'util/dsn.php');
$item = new MediaItem();

$mangaArrayObj = $item->readAllBookType($db);

// Verifica se l'utente è loggato
$user = $_SESSION['user'] ?? null;

$arrOfMediaItems = [];
if ($user) {
    // Carica i media seguiti dall'utente
    $userMediaItem = $user->getMediaItem();
    foreach ($userMediaItem as $item) {
        $items = new MediaItem();
        $items = $items->loadMediaItem($item['media_item_id'], $db);
        if ($items) {
            $arrOfMediaItems[] = $items;
        }
    }
}



?>
<div class="container-md mt-4 p-4 border rounded bg-light">
    <h3 class="text-center mb-4">Ricerca MediaItem</h3>
    <form method="GET" action="filteredManga.php">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="title" class="form-control" placeholder="Cerca per titolo" value="<?= htmlspecialchars($_GET['title'] ?? '') ?>">
            </div>
            <div class="col-md-4">
                <input type="text" name="author" class="form-control" placeholder="Cerca per autore" value="<?= htmlspecialchars($_GET['author'] ?? '') ?>">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filtra</button>
            </div>
        </div>
    </form>

</div>

<div class="container mt-4 my-4">
    <h2 class="text-center">Lista dei Manga</h2>
    <?php if (!empty($mangaArrayObj)): ?>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Titolo</th>
                <th>Autore</th>
                <?php if ($user): ?>
                    <th>Seguito</th>
                    <th>Azioni</th>
                <?php endif; ?>
                <th>Dettagli</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($mangaArrayObj as $manga): ?>
                <?php
                // Determina se il manga è seguito, solo se l'utente è loggato
                $isFollowed = false;
                if ($user) {
                    foreach ($arrOfMediaItems as $followedItem) {
                        if ($manga->getId() === $followedItem->getId()) {
                            $isFollowed = true;
                            break;
                        }
                    }
                }
                ?>
                <tr class="<?= $user && $isFollowed ? 'table-success' : '' ?>">
                    <td><?= htmlspecialchars($manga->getId()) ?></td>
                    <td><?= htmlspecialchars($manga->getTitle()) ?></td>
                    <td><?= htmlspecialchars($manga->getAuthor()) ?></td>
                    <?php if ($user): ?>
                        <td>
                            <?php if ($isFollowed): ?>
                                <span class="badge bg-success">Seguito</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Non seguito</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($isFollowed): ?>
                                <!-- Pulsante Unfollow -->
                                <form action="user/unfollow.php" method="POST" class="d-inline">
                                    <input type="hidden" name="media_item_id" value="<?= htmlspecialchars($manga->getId()) ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Unfollow</button>
                                </form>
                            <?php else: ?>
                                <!-- Pulsante Follow -->
                                <form action="user/follow.php" method="POST" class="d-inline">
                                    <input type="hidden" name="media_item_id" value="<?= htmlspecialchars($manga->getId()) ?>">
                                    <button type="submit" class="btn btn-primary btn-sm">Follow</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>
                    <td>
                        <a href="viewDetails.php?id=<?= htmlspecialchars($manga->getId()) ?>" class="btn btn-light text-decoration-none">
                            dettagli
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">Nessun Media di tipo 'Book' trovato.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
