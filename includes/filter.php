<?php

if(!isset($_GET['title'],$_GET['release_date'],$_GET['episodes'],$_GET['chapters'])){
    $_GET['title'] = $_GET['title'] ?? '';
    $_GET['release_date'] = $_GET['release_date'] ?? '';
    $_GET['episodes'] = $_GET['episodes'] ?? '';
    $_GET['chapters'] = $_GET['chapters']  ?? '';
}
var_dump($_GET);
?>

<div class="container-md mt-4 p-4 border rounded bg-light">
    <h3 class="text-center mb-4">Ricerca MediaItem</h3>
    <form id="search-form" class="row gy-3" method="GET">
        <!-- Filtro Titolo -->
        <div class="col-md-4">
            <label for="search-title" class="form-label">Titolo:</label>
            <input type="text" id="search-title" name="title" class="form-control" placeholder="Inserisci il titolo" />
        </div>

        <!-- Filtro Data di uscita -->
        <div class="col-md-4">
            <label for="search-date" class="form-label">Data di uscita:</label>
            <input type="date" id="search-date" name="release_date" class="form-control" />
        </div>

        <!-- Numero di Capitoli -->
        <div class="col-md-2">
            <label for="chapter-number" class="form-label">Capitoli:</label>
            <input type="number" id="chapter-number" name="chapters" class="form-control" placeholder="Inserisci numero" />
        </div>

        <!-- Numero di Episodi -->
        <div class="col-md-2">
            <label for="episode-number" class="form-label">Episodi:</label>
            <input type="number" id="episode-number" name="episodes" class="form-control" placeholder="Inserisci numero" />
        </div>

        <!-- Pulsanti -->
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-2">Cerca</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
    </form>
</div>
