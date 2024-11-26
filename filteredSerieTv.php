<?php
include 'classes/User.php';
include 'classes/Database.php';
include 'classes/MediaItem.php';
include 'util/function.php';
include 'includes/header.php';

$db = new Database(include 'util/dsn.php');
$item = new MediaItem();



// Verifica se l'utente è loggato
$user = $_SESSION['user'] ?? null;
if($_SERVER['REQUEST_METHOD'] == 'GET') {

    $title = $_GET['title'] ?? '';
    $author = $_GET['author'] ?? '';


    $videoArrayObj = readFilteredVideoType($db, $title, $author);
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
}
?>
<div class="container mt-4">
    <h2 class="text-center">Lista dei Manga</h2>
    <?php if (!empty($videoArrayObj)): ?>
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
            <?php foreach ($videoArrayObj as $video): ?>
                <?php
                // Determina se l'item è seguito, solo se l'utente è loggato
                $isFollowed = false;
                if ($user) {
                    foreach ($arrOfMediaItems as $followedItem) {
                        if ($video->getId() === $followedItem->getId()) {
                            $isFollowed = true;
                            break;
                        }
                    }
                }
                ?>
                <tr class="<?= $user && $isFollowed ? 'table-success' : '' ?>">
                    <td><?= htmlspecialchars($video->getId()) ?></td>
                    <td><?= htmlspecialchars($video->getTitle()) ?></td>
                    <td><?= htmlspecialchars($video->getAuthor()) ?></td>
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
                                    <input type="hidden" name="media_item_id" value="<?= htmlspecialchars($video->getId()) ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Unfollow</button>
                                </form>
                            <?php else: ?>
                                <!-- Pulsante Follow -->
                                <form action="user/follow.php" method="POST" class="d-inline">
                                    <input type="hidden" name="media_item_id" value="<?= htmlspecialchars($video->getId()) ?>">
                                    <button type="submit" class="btn btn-primary btn-sm">Follow</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>
                    <td>
                        <a href="viewDetails.php?id=<?= htmlspecialchars($video->getId()) ?>" class="btn btn-light text-decoration-none">
                            dettagli
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">Nessun Media di tipo 'Video' trovato.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
