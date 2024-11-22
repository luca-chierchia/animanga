<?php
include 'classes/User.php';
include 'classes/Database.php';
include 'util/function.php';

$db = new Database(include 'util/dsn.php');
$msg = [
    'failed'    => "",
    'success'   => "",
    'error'     => "",
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['psw'] ?? '', ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8');

    // Controllo che il form sia compilato
    $nameTest = dbContainsUser($username, $db);
    if ($nameTest) {
        $msg['failed'] = "L'username scelto è già esistente";
    } else {
        $user = User::newUser($username, $password, $email, $db);
        if ($user) {
            $msg['success'] = "Nuovo utente creato";
            header('location: index.php');
            exit();
        } else {
            $msg['error'] = "Errore: non è possibile creare l'utente";
            header('location: registration.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .message.failed {
            background-color: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Registrazione</h2>
    <?php if (!empty($msg['failed'])): ?>
        <div class="message failed"><?php echo $msg['failed']; ?></div>
    <?php elseif (!empty($msg['success'])): ?>
        <div class="message success"><?php echo $msg['success']; ?></div>
    <?php elseif (!empty($msg['error'])): ?>
        <div class="message error"><?php echo $msg['error']; ?></div>
    <?php endif; ?>

    <form method="POST" action="registration.php">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="Inserisci il nome utente" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Inserisci la tua email" required>
        </div>
        <div class="form-group">
            <label for="psw">Password:</label>
            <input type="password" name="psw" placeholder="Inserisci la password" required>
        </div>
        <button type="submit">Registrati</button>
    </form>
</div>
</body>
</html>
