<?php
$status = isset($_GET['operazione']) ? $_GET['operazione'] : 'unknown';
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esito Creazione</title>
    <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

    <?php if ($status === 'confirmed'): ?>
        <div class="alert alert-success" role="alert">
            Il media è stato aggiornato con successo!
        </div>
    <?php elseif ($status === 'notConfirmed'): ?>
        <div class="alert alert-danger" role="alert">
            Il media non è stato aggiornato.
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