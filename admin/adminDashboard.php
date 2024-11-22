<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa; /* Grigio chiaro per il background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1rem;
        }

        .dashboard-container {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        .btn-wrapper {
            position: relative;
            margin-bottom: 2rem;
        }

        .btn-crud {
            font-size: 1.2rem;
            padding: 0.75rem 1.5rem;
            position: relative;
            z-index: 1;
        }

        .description {
            display: none;
            position: absolute;
            bottom: -40px; /* Posiziona la descrizione sotto il pulsante */
            left: 50%;
            transform: translateX(-50%);
            background: #343a40;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-size: 0.9rem;
            white-space: nowrap;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 0;
        }

        .btn-wrapper:hover .description {
            display: block;
            z-index: 9999;
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    <h1>Admin Dashboard</h1>
    <p class="welcome-message">Benvenuto, <strong><?= htmlspecialchars($_SESSION['username']); ?></strong>. Qui puoi gestire i dati del sistema utilizzando le operazioni CRUD.</p>

    <!-- Pulsanti CRUD con descrizioni al passaggio del mouse -->
    <div class="btn-wrapper">
        <a href="../cms/create.php" class="btn btn-success btn-crud">Create</a>
        <div class="description">Aggiungi nuovi Media</div>
    </div>

    <div class="btn-wrapper">
        <a href="../cms/read.php" class="btn btn-primary btn-crud">Read</a>
        <div class="description">Visualizza i Media</div>
    </div>

    <div class="btn-wrapper">
        <a href="../cms/update.php" class="btn btn-warning btn-crud">Update</a>
        <div class="description">Aggiorna i dati dei Media</div>
    </div>

    <div class="btn-wrapper">
        <a href="../cms/read.php" class="btn btn-danger btn-crud">Delete</a>
        <div class="description">Rimuovi i dati dei Media</div>
    </div>

    <div class="btn-wrapper">
        <a href="../index.php" class="btn" > Home </a>
        <a href="../logout.php" class="btn  "> Logout</a>
    </div>
</div>
</body>
</html>
