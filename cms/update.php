<?php
include '../util/function.php';
include '../classes/Database.php';

session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

$idItem = $_GET['id'] ?? null;
$db = new Database(include '../util/dsn.php');

if(!dbContainsId($idItem, $db)){
    header('Location: ../util/errorPage.php');
    exit();
}


?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Media</title>
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
<div class="form-container">
    <h1>Aggiorna Media</h1>
    <form method="POST" action="uProcessed.php">
        <!-- ID (readonly) -->
        <div class="form-group">
            <label for="id">ID:</label>
            <input type="number" id="id" name="id" class="form-control" value="<?= $media['id'] ?? '' ?>" readonly required>
        </div>

        <!-- Titolo -->
        <div class="form-group">
            <label for="title">Titolo:</label>
            <input type="text" id="title" name="title" class="form-control" value="<?= $media['title'] ?? '' ?>" required>
        </div>

        <!-- Autore -->
        <div class="form-group">
            <label for="author">Autore:</label>
            <input type="text" id="author" name="author" class="form-control" value="<?= $media['author'] ?? '' ?>" required>
        </div>

        <!-- Tipo di Media -->
        <div class="form-group">
            <label for="mediaType">Tipo di Media:</label>
            <select id="mediaType" name="media_type" class="form-control" required>
                <option value="">Seleziona</option>
                <option value="video" <?= isset($media['media_type']) && $media['media_type'] === 'video' ? 'selected' : '' ?>>Video</option>
                <option value="book" <?= isset($media['media_type']) && $media['media_type'] === 'book' ? 'selected' : '' ?>>Book</option>
            </select>
        </div>

        <!-- Descrizione -->
        <div class="form-group">
            <label for="description">Descrizione:</label>
            <textarea id="description" name="description" class="form-control" rows="5" required><?= $media['description'] ?? '' ?></textarea>
        </div>

        <!-- Data di Rilascio -->
        <div class="form-group">
            <label for="releaseDate">Data di Rilascio:</label>
            <input type="date" id="releaseDate" name="release_date" class="form-control" value="<?= $media['release_date'] ?? '' ?>" required>
        </div>

        <!-- Campi specifici per Video -->
        <div id="videoFields" class="optional-field" <?= isset($media['media_type']) && $media['media_type'] === 'video' ? 'style="display: block;"' : '' ?>>
            <div class="form-group">
                <label for="totalSeasons">Stagioni Totali:</label>
                <input type="number" id="totalSeasons" name="stagioni_totali" class="form-control" min="0" value="<?= $media['stagioni_totali'] ?? 0 ?>">
            </div>
            <div class="form-group">
                <label for="totalEpisodes">Episodi Totali:</label>
                <input type="number" id="totalEpisodes" name="episodi_totali" class="form-control" min="0" value="<?= $media['episodi_totali'] ?? 0 ?>">
            </div>
        </div>

        <!-- Campi specifici per Book -->
        <div id="bookFields" class="optional-field" <?= isset($media['media_type']) && $media['media_type'] === 'book' ? 'style="display: block;"' : '' ?>>
            <div class="form-group">
                <label for="totalVolumes">Volumi Totali:</label>
                <input type="number" id="totalVolumes" name="volumi_totali" class="form-control" min="0" value="<?= $media['volumi_totali'] ?? 0 ?>">
            </div>
            <div class="form-group">
                <label for="totalChapters">Capitoli Totali:</label>
                <input type="number" id="totalChapters" name="capitoli_totali" class="form-control" min="0" value="<?= $media['capitoli_totali'] ?? 0 ?>">
            </div>
        </div>

        <!-- Pulsante di invio -->
        <div class="form-group text-center">
            <p>Aggiorna il MediaItem</p>
            <button type="submit" name="confirm" value="yes" class="btn btn-danger">Sì</button>
            <button type="submit" name="confirm" value="no" class="btn btn-secondary">No</button>
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

