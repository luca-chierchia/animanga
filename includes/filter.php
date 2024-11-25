<?php


if (!isset($_GET['title'], $_GET['release_year'], $_GET['episodes'], $_GET['chapters'])) {
    $_GET['title'] = $_GET['title'] ?? '';
    $_GET['release_date'] = $_GET['release_date'] ?? '';
    $_GET['episodi_totali'] = $_GET['episodi_totali'] ?? '';
    $_GET['capitoli_totali'] = $_GET['capitoli_totali'] ?? '';
    $pagina = $_SERVER['PHP_SELF'];
    if ($pagina === '/manga.php') {
        $_GET['media_type'] = 'book';
        $field = [
                "title"             => $_GET['title'] ,
                "release_date"      => $_GET['release_date'],
                "capitoli_totali"   => $_GET['capitoli_totali'],
                "media_type"        => $_GET['media_type'],
        ];
    } elseif ($pagina === '/serieTv.php') {
        $_GET['media_type'] = 'video';
        $field = [
            "title"             => $_GET['title'] ,
            "release_date"      => $_GET['release_date'],
            "episodi_totali"    => $_GET['episodi_totali'],
            "media_type"        => $_GET['media_type'],
        ];
    } else {
        $_GET['media_type'] = '';
    }

}

var_dump($field);

?>

<div class="container-md mt-4 p-4 border rounded bg-light">
    <h3 class="text-center mb-4">Ricerca MediaItem</h3>
    <form id="search-form" class="row gy-3" method="GET">
        <!-- Filtro Titolo -->
        <div class="col-md-4">
            <label for="title" class="form-label">Titolo:</label>
            <input type="text" id="search-title" name="title" class="form-control" placeholder="Inserisci il titolo" />
        </div>

        <!-- Filtro Anno di Uscita -->
        <div class="col-md-4">
            <label for="release_date" class="form-label">Anno di Uscita:</label>
            <select id="release_date" name="release_date" class="form-select">
                <option value="">Seleziona Anno</option>
                <?php for ($year = date('Y'); $year >= 1950; $year--): ?>
                    <option value="<?= $year ?>"><?= $year ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <?php if ($_GET['media_type'] === 'video'): ?>
            <!-- Filtro Episodi Totali (solo per video) -->
            <div class="col-md-4">
                <label for="episodi_totali" class="form-label">Episodi Totali:</label>
                <select id="episode-range" name="episodi_totali" class="form-select">
                    <option value="">Seleziona Range</option>
                    <option value="20">0-20</option>
                    <option value="50">20-50</option>
                    <option value="100">50-100</option>
                    <option value=">101">Più di 100</option>
                </select>
            </div>
        <?php elseif ($_GET['media_type'] === 'book'): ?>
            <!-- Filtro Capitoli Totali (solo per libri) -->
            <div class="col-md-4">
                <label for="capitoli_totali" class="form-label">Capitoli Totali:</label>
                <select id="chapter-range" name="capitoli_totali" class="form-select">
                    <option value="">Seleziona Range</option>
                    <option value="20">0-20</option>
                    <option value="50">20-50</option>
                    <option value="100">50-100</option>
                    <option value="101">Più di 100</option>
                </select>
            </div>
        <?php endif; ?>

        <!-- Pulsanti -->
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-2">Cerca</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
    </form>
</div>
