<!DOCTYPE html>
<html>
<head>
    <title>Animanga</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="Anime, Manga,SerieTV">
    <meta name="description" content="Sito per appassionati di manga, anime e serie tv">
    <meta name="author" content="Luca Chierchia">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet" >
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>
<body>
<?php
session_start();

// Controlla se c'è una sessione attiva
if (isset($_SESSION['username'])) {
    $isAdmin = $_SESSION['username'] === 'admin';
    $isLoggedIn = true;
    $username = htmlspecialchars($_SESSION['username']);
} else {
    $isLoggedIn = false;
}
?>
<header class="container-md vh-25">
    <div class="hero text-center text-light position-relative" style="background-image: url('asset/img/serie-tv-streaming-1024x576.jpg')">
        <div class="overlay"></div>
        <div class="content position-relative z-index-2">
            <h1>Benvenuti su Animanga</h1>
            <p class="lead">Scopri gli anime e i manga più popolari e seguiti dalla community</p>
            <a href="#anime" class="btn btn-primary btn-lg mt-3">Esplora Anime</a>
            <a href="#manga" class="btn btn-secondary btn-lg mt-3">Scopri i Manga</a>
        </div>
    </div>
    <nav class="navbar  d-flex justify-content-between align-items-center " id="navbarItem">

            <ul class="navbar-nav flex-row ">
                <li class="nav-item mx-2"> <a class="nav-link" href="index.php"> Home </a> </li>
                <li class="nav-item mx-2"> <a class="nav-link" href="manga.php"> Manga </a> </li>
                <li class="nav-item mx-2"> <a class="nav-link" href="serieTv.php"> Serie TV</a> </li>
            </ul>


        <ul class="navbar-nav flex-row">
            <?php if ($isLoggedIn): ?>
                <!-- Utente loggato -->
                <li class="nav-item mx-2">
                    <span class="nav-link text-primary">Benvenuto, <?php echo $username; ?>!</span>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link btn btn-outline-danger btn-sm" href="logout.php">Logout</a>
                </li>
                <?php if($isAdmin): ?>
                    <li class="nav-item mx-2">
                        <a class="nav-link btn btn-success btn-sm" href="admin/adminDashboard.php">Area Riservata</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item mx-2">
                        <a class="nav-link btn btn-success btn-sm" href="user/userDashboard.php">Area Riservata</a>
                    </li>
                <?php endif; ?>
            <?php else: ?>
                <!-- Utente non loggato -->
                <li class="nav-item mx-2">
                    <a class="nav-link btn btn-primary btn-sm" href="login.php">Login</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link btn btn-outline-secondary btn-sm" href="registrazione.php">Registrati</a>
                </li>
            <?php endif; ?>
        </ul>

    </nav>
</header>
