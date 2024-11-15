<?php
session_start();
echo "ciao sono la userDashboard";

if (isset($_SESSION['username'])) {
    echo "Benvenuto, " . $_SESSION['username'];
} else {
    echo "Non sei loggato.";
}