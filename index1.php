<?php
include 'includes/header.php' ;
include 'classes/User.php';
?>

<main>
    <?php

    $user = User::loadByCredentials('Mario','potter21');
    if($user)
        echo "utente trovato";
    else
        echo "utente non trovato"


    ?>
    <section id="anime" class="m-3 ">
        <!-- Carosello degli anime più guardati-->

        <div class="container-md my-4">
            <h2 class="">Anime</h2>
            <p>In questa sezione vengono proposti gli anime più guardati dagli utenti.<br> Puoi specificare delle preferenze con i 3 menu a tendina</p>
            <div class="row">
                <div class="col-md-4">
                    <label for="filter-category" class="form-label">Categoria</label>
                    <select id="filter-category" class="form-select">
                        <option selected>Scegli una categoria</option>
                        <option value="1">Anime</option>
                        <option value="2">Manga</option>
                        <option value="3">Serie TV</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="filter-status" class="form-label">Stato</label>
                    <select id="filter-status" class="form-select">
                        <option selected>Scegli uno stato</option>
                        <option value="ongoing">In corso</option>
                        <option value="completed">Completato</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="filter-year" class="form-label">Anno</label>
                    <select id="filter-year" class="form-select">
                        <option selected>Scegli un anno</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <!-- Aggiungi altri anni se necessario -->
                    </select>
                </div>
            </div>
        </div>

        <!-- Risultati della Ricerca -->
        <div class="container-md my-4 border-bottom">
            <div class="row justify-content-between">
                <div class="col-md-3 mb-4">
                    <h3>Title</h3>
                    <p><strong>Author:</strong> Nome Autore</p>
                    <p><strong>Cap:</strong> Numero Capitolo</p>
                    <p><strong>Descrizione:</strong> Breve descrizione del contenuto...</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h3>Title</h3>
                    <p><strong>Author:</strong> Nome Autore</p>
                    <p><strong>Cap:</strong> Numero Capitolo</p>
                    <p><strong>Descrizione:</strong> Breve descrizione del contenuto...</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h3>Title</h3>
                    <p><strong>Author:</strong> Nome Autore</p>
                    <p><strong>Cap:</strong> Numero Capitolo</p>
                    <p><strong>Descrizione:</strong> Breve descrizione del contenuto...</p>
                </div>
            </div>
        </div>

    </section>

    <section>
        <!-- Carosello degli manga più letti-->

        <div class="container-md my-4">
            <h2 class="">Manga</h2>
            <p>In questa sezione vengono proposti i manga più letti dagli utenti.<br> Puoi specificare delle preferenze con i 3 menu a tendina</p>
            <div class="row">
                <div class="col-md-4">
                    <label for="filter-category" class="form-label">Categoria</label>
                    <select id="filter-category" class="form-select">
                        <option selected>Scegli una categoria</option>
                        <option value="1">Anime</option>
                        <option value="2">Manga</option>
                        <option value="3">Serie TV</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="filter-status" class="form-label">Stato</label>
                    <select id="filter-status" class="form-select">
                        <option selected>Scegli uno stato</option>
                        <option value="ongoing">In corso</option>
                        <option value="completed">Completato</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="filter-year" class="form-label">Anno</label>
                    <select id="filter-year" class="form-select">
                        <option selected>Scegli un anno</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <!-- Aggiungi altri anni se necessario -->
                    </select>
                </div>
            </div>
        </div>

        <!-- Risultati della Ricerca -->
        <div class="container-md my-4 border-bottom">
            <div class="row justify-content-between">
                <div class="col-md-3 mb-4">
                    <h3>Title</h3>
                    <p><strong>Author:</strong> Nome Autore</p>
                    <p><strong>Cap:</strong> Numero Capitolo</p>
                    <p><strong>Descrizione:</strong> Breve descrizione del contenuto...</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h3>Title</h3>
                    <p><strong>Author:</strong> Nome Autore</p>
                    <p><strong>Cap:</strong> Numero Capitolo</p>
                    <p><strong>Descrizione:</strong> Breve descrizione del contenuto...</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h3>Title</h3>
                    <p><strong>Author:</strong> Nome Autore</p>
                    <p><strong>Cap:</strong> Numero Capitolo</p>
                    <p><strong>Descrizione:</strong> Breve descrizione del contenuto...</p>
                </div>
            </div>
        </div>

    </section>

    <section>
        <!-- Carosello delle SerieTV più guardate-->



    </section>
</main>
<?php include 'includes/footer.php' ?>

