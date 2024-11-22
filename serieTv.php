<?php
include 'includes/header.php';
include 'classes/Database.php';
include 'classes/MediaItem.php';

$db = new Database(include 'util/dsn.php');
$item = new MediaItem();

$videoArrayObj = $item->readAllVideoType($db);
?>
<?php include 'includes/filter.php'  ?>
<div class="container mt-4">
    <h2 class="text-center">Lista dei Manga</h2>
    <?php if (!empty($videoArrayObj)): ?>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Titolo</th>
                <th>Autore</th>
                <th>Dettagli</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($videoArrayObj as $video): ?>
                <tr>
                    <td><?= htmlspecialchars($video->getId()) ?></td>
                    <td><?= htmlspecialchars($video->getTitle()) ?></td>
                    <td><?= htmlspecialchars($video->getAuthor()) ?></td>
                    <td><a href="viewDetails.php?id=<?= htmlspecialchars($video->getId()) ?>" class="btn btn-light text-decoration-none">dettagli</a> </td>

                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">Nessun Media di tipo 'Book' trovato.</p>
    <?php endif; ?>
</div>





<?php include 'includes/footer.php' ?>
