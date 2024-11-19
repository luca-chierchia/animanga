<?php
include '../util/function.php';
include '../classes/Database.php';

session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}
$idItem = $_GET['id'] ?? null;
$db = new Database(include '../util/dsn.php');

if(!dbContainsId($idItem, $db)){
    header('Location: ../util/errore.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conferma Eliminazione</title>
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h4>Conferma Eliminazione</h4>
                </div>
                <div class="card-body">
                    <p>Vuoi eliminare il MediaItem con ID: <strong><?php echo htmlspecialchars($idItem); ?></strong>?</p>
                    <form method="POST" action="dProcessed.php">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($idItem); ?>">
                        <div class="d-flex justify-content-between">
                            <button type="submit" name="confirm" value="yes" class="btn btn-danger">Sì</button>
                            <button type="submit" name="confirm" value="no" class="btn btn-secondary">No</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
