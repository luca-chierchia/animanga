<?php
include "includes/header.php";
include "classes/Database.php";
include 'classes/User.php';
include "classes/MediaItem.php";
include 'util/function.php';
$config = include 'util/dsn.php';
$db = new Database($config);
?>

<main>

    <section id="anime" class="m-3">
        <!-- Carosello degli anime più guardati-->

        <div class="container-md my-4 text-center">
            <h2 class="section-title">Serie TV</h2>
            <p>In questa sezione vengono proposte le Serie TV più seguite dagli utenti.</p>
        </div>

        <?php
        $arrMostFollowedSeries = mostFollowed('video', $db);
        $arrOfAnimeItem = [];

        foreach ($arrMostFollowedSeries as $mostFollowedSeries) {
            $item = new MediaItem();
            $item->loadMediaItem($mostFollowedSeries['media_item_id'], $db);
            $arrOfAnimeItem[] = $item;
        }
        ?>
        <!-- Risultati della Ricerca -->
        <div class="container-md my-4 border-bottom">
            <div class="row justify-content-between g-4">
                <?php foreach ($arrOfAnimeItem as $item) { ?>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm">

                            <div class="card-body" style="max-width: 300px; height: 400px; overflow: hidden;">
                                <h5 class="card-title"><?php echo htmlspecialchars($item->getTitle(), ENT_QUOTES, 'UTF-8'); ?></h5>
                                <p class="card-text"><strong>Author:</strong> <?php echo htmlspecialchars($item->getAuthor(), ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="card-text"><strong>Ep:</strong> <?php echo htmlspecialchars($item->getEpisodiTotali(), ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="card-text"><strong>Descrizione:</strong> <?php echo htmlspecialchars($item->getDescription(), ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <a href="viewDetails.php?id=<?= htmlspecialchars($item->getId(), ENT_QUOTES, 'UTF-8') ?>" class="btn btn-primary w-100">Vai nei dettagli</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    </section>

    <section id="manga">
        <!-- Carosello degli manga più letti-->

        <div class="container-md my-4 text-center">
            <h2 class="section-title">Manga</h2>
            <p>In questa sezione vengono proposti i manga più letti dagli utenti.</p>
        </div>

        <?php
        $arrMostFollowedMangas = mostFollowed('book', $db);
        $arrOfMangaItem = [];

        foreach ($arrMostFollowedMangas as $mostFollowedMangas) {
            $item = new MediaItem();
            $item->loadMediaItem($mostFollowedMangas['media_item_id'], $db);
            $arrOfMangaItem[] = $item;
        }
        ?>
        <!-- Risultati della Ricerca -->
        <div class="container-md my-4 border-bottom">
            <div class="row justify-content-between g-4">
                <?php foreach ($arrOfMangaItem as $item) { ?>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm" >

                            <div class="card-body" style="max-width: 300px; height: 400px; overflow: hidden;">
                                <h5 class="card-title"><?php echo htmlspecialchars($item->getTitle(), ENT_QUOTES, 'UTF-8'); ?></h5>
                                <p class="card-text"><strong>Author:</strong> <?php echo htmlspecialchars($item->getAuthor(), ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="card-text"><strong>Cap:</strong> <?php echo htmlspecialchars($item->getCapitoliTotali(), ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="card-text"><strong>Descrizione:</strong> <?php echo htmlspecialchars($item->getDescription(), ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <a href="viewDetails.php?id=<?= htmlspecialchars($item->getId(), ENT_QUOTES, 'UTF-8') ?>" class="btn btn-primary w-100">Vai nei dettagli</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    </section>

</main>
<?php include 'includes/footer.php' ?>
