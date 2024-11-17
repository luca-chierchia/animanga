<?php

// Avvia la sessione
session_start();

// Svuota tutte le variabili di sessione
$_SESSION = array();

// Se desideri eliminare anche il cookie di sessione, esegui questi passaggi
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    // Imposta il cookie con una data di scadenza nel passato
    setcookie(session_name(), '', time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Distruggi la sessione
session_destroy();

// Reindirizza l'utente alla pagina di login o a una pagina di conferma logout
header("Location: index.php");
exit();
?>



