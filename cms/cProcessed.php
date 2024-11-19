<?php
$status = isset($_GET['processed']) ? $_GET['processed'] : 'unknown';
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esito Creazione</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

    <?php if ($status === 'success'): ?>
        <div class="alert alert-success" role="alert">
            Il media è stato creato con successo!
        </div>
    <?php elseif ($status === 'fail'): ?>
        <div class="alert alert-danger" role="alert">
            Si è verificato un errore durante la creazione del media. Riprova.
        </div>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            Stato dell'operazione sconosciuto.
        </div>
    <?php endif; ?>
    <a href="../admin/adminDashboard.php" class="btn btn-primary">Torna alla dashboard</a>
</div>
</body>
</html>