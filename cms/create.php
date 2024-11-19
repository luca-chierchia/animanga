<?php
include "../classes/Database.php";
include "../classes/MediaItem.php";

session_start();
$config = include "../util/dsn.php";
$db = new Database($config);
$msg = "";
$processed = "";
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}


if (isset($_POST['title'], $_POST['author'], $_POST['media_type'], $_POST['description'],$_POST['release_date']) && !empty($_POST['media_type'])) {
    $_POST['release_date'] = date("Y-m-d");
    $_POST['stagioni_totali'] = $_POST['stagioni_totali'] ?? 0;
    $_POST['episodi_totali']  = $_POST['episodi_totali'] ?? 0;
    $_POST['volumi_totali']   = $_POST['volumi_totali'] ?? 0;
    $_POST['capitoli_totali'] = $_POST['capitoli_totali'] ?? 0;


    try {

        $item = new MediaItem();
        $test = $item->create($_POST, $db);
        $processed = "success";
        header('Location: cProcessed.php?processed=' . $processed);
        exit();

    }catch (Exception $e) {
        $processed = "fail";
        header('Location: cProcessed.php?processed=' . $processed);
        exit();
    }

} else {
    $msg = "Compila tutti i campi obbligatori.";
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Media</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1rem;
        }

        .form-container {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .form-container h1 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group textarea {
            resize: none;
        }

        .form-group select, .form-group input, .form-group textarea {
            width: 100%;
        }

        .optional-field {
            display: none;
        }
    </style>
</head>
<body>
<div style="position:absolute; top: 0"></div>

<div class="form-container">
    <h1>Crea Nuovo Media</h1>
    <form method="POST" action="create.php">
        <!-- Titolo -->
        <div class="form-group">
            <label for="title">Titolo:</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="Inserisci il titolo" required>
        </div>

        <!-- Autore -->
        <div class="form-group">
            <label for="author">Autore:</label>
            <input type="text" id="author" name="author" class="form-control" placeholder="Inserisci l'autore" required>
        </div>

        <!-- Tipo di Media -->
        <div class="form-group">
            <label for="mediaType">Tipo di Media:</label>
            <select id="mediaType" name="media_type" class="form-control" required>
                <option value="">Seleziona</option>
                <option value="video">Video</option>
                <option value="book">Book</option>
            </select>
        </div>

        <!-- Descrizione -->
        <div class="form-group">
            <label for="description">Descrizione:</label>
            <textarea id="description" name="description" class="form-control" rows="5"
                      placeholder="Inserisci una descrizione" required></textarea>
        </div>

        <div class="form-group">
            <label for="releaseDate">Data di Rilascio:</label>
            <input type="date" id="releaseDate" name="release_date" class="form-control" value="<?= date('Y-m-d'); ?>">
        </div>

        <!-- Campi specifici per Video -->
        <div id="videoFields" class="optional-field">
            <div class="form-group">
                <label for="totalSeasons">Stagioni Totali:</label>
                <input type="number" id="totalSeasons" name="stagioni_totali" class="form-control" min="0" value ="1"
                       placeholder="Inserisci il numero di stagioni">
            </div>
            <div class="form-group">
                <label for="totalEpisodes">Episodi Totali:</label>
                <input type="number" id="totalEpisodes" name="episodi_totali" class="form-control" min="0" value ="1"
                       placeholder="Inserisci il numero di episodi">
            </div>
        </div>

        <!-- Campi specifici per Book -->
        <div id="bookFields" class="optional-field">
            <div class="form-group">
                <label for="totalVolumes">Volumi Totali:</label>
                <input type="number" id="totalVolumes" name="volumi_totali" class="form-control" min="0" value="1"
                       placeholder="Inserisci il numero di volumi">
            </div>
            <div class="form-group">
                <label for="totalChapters">Capitoli Totali:</label>
                <input type="number" id="totalChapters" name="capitoli_totali" class="form-control" min="0" value="1"
                       placeholder="Inserisci il numero di capitoli">
            </div>
        </div>

        <!-- Pulsante di invio -->
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary w-100">Salva Media</button>
        </div>
    </form>
</div>

<script>
    // Gestione dinamica dei campi opzionali
    const mediaTypeSelect = document.getElementById('mediaType');
    const videoFields = document.getElementById('videoFields');
    const bookFields = document.getElementById('bookFields');

    mediaTypeSelect.addEventListener('change', function () {
        const selectedValue = mediaTypeSelect.value;

        if (selectedValue === 'video') {
            videoFields.style.display = 'block';
            bookFields.style.display = 'none';
        } else if (selectedValue === 'book') {
            videoFields.style.display = 'none';
            bookFields.style.display = 'block';
        } else {
            videoFields.style.display = 'none';
            bookFields.style.display = 'none';
        }
    });
</script>

</body>
</html>
