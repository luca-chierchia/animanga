<?php
include 'classes/Database.php';
include 'classes/User.php';
$db = new Database(include 'util/dsn.php');
$result = User::newUser('testuser', 'securepassword123', 'test@example.com', $db);

if ($result) {
    echo "Utente creato con successo!";
} else {
    echo "Errore nella creazione dell'utente.";
}
