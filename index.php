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

    <section id="anime" class="m-3 ">
        <!-- Carosello degli anime più guardati-->

        <div class="container-md my-4 text-center">
            <h2 class="">Serie TV</h2>
            <p>In questa sezione vengono proposte le Serie TV più seguite dagli utenti.</p>

        </div>

        <?php
        $arrMostFollowedSeries = mostFollowed('video',$db);
        $arrOfAnimeItem = [];

        foreach ($arrMostFollowedSeries as $mostFollowedSeries) {
            $item = new MediaItem();
            $item->loadMediaItem($mostFollowedSeries['media_item_id'],$db);
            $arrOfAnimeItem[] = $item;

        }
        var_dump($arrMostFollowedSeries);
        ?>
        <!-- Risultati della Ricerca -->
        <div class="container-md my-4 border-bottom">
            <div class="row justify-content-between">
                <?php foreach ($arrOfAnimeItem as $item) { ?>
                <div class="col-md-3 mb-4">
                    <h3> <?php echo $item->getTitle() ?></h3>
                    <p><strong>Author:</strong> <?php echo $item->getAuthor(); ?></p>
                    <p><strong>Ep:</strong> <?php  echo $item->getEpisodiTotali(); ?></p>
                    <p><strong>Descrizione:</strong> <?php echo $item->getDescription(); ?></p>
                </div> <?php } ?>
        </div>


    </section>

    <section id="manga">
        <!-- Carosello degli manga più letti-->

        <div class="container-md my-4 text-center">
            <h2 class="">Manga</h2>
            <p>In questa sezione vengono proposti i manga più letti dagli utenti.</p>

            </div>
        </div>

        <?php
        $arrMostFollowedMangas = mostFollowed('book',$db);
        $arrOfMangaItem = [];

        foreach ($arrMostFollowedMangas as $mostFollowedMangas) {
            $item = new MediaItem();
            $item->loadMediaItem($mostFollowedMangas['media_item_id'],$db);
            $arrOfMangaItem[] = $item;

        }
        var_dump($arrMostFollowedMangas);
        ?>
        <!-- Risultati della Ricerca -->
        <div class="container-md my-4 border-bottom">
            <div class="row justify-content-between">
                <?php foreach ($arrOfMangaItem as $item) { ?>
                    <div class="col-md-3 mb-4">
                        <h3> <?php echo $item->getTitle() ?></h3>
                        <p><strong>Author:</strong> <?php echo $item->getAuthor(); ?></p>
                        <p><strong>Cap:</strong> <?php  echo $item->getEpisodiTotali(); ?></p>
                        <p><strong>Descrizione:</strong> <?php echo $item->getDescription(); ?></p>
                    </div> <?php } ?>
            </div>
        </div>

    </section>

</main>
<?php include 'includes/footer.php' ?>

