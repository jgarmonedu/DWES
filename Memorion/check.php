<?php

session_name('memorion');
session_start();

if (!isset($_SESSION['numImages']) || !isset($_SESSION['images'])) {
    header("Location:memorion.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numberImages = isset($_POST['numberImages']) ? htmlentities($_POST['numberImages']) : '';
    $numberImagesOk = false;
    var_dump($numberImages);
    if ($numberImages=='') {
    } elseif (!is_numeric($numberImages)) {
    } elseif (!ctype_digit($numberImages)) {
    } elseif ($numberImages<2 || $numberImages>61) {
    } else {
        $numberImagesOk = true;
    }

    if ($numberImagesOk) {
        $_SESSION['numImages']=$numberImages;
        // Borramos la partida
        unset($_SESSION['images']);
        // Redirigimos a la segunda página
        header("Location:memorion.php");
        exit;
    }
}

// Redirigimos a la tercera página
header("Location:configuration.php");

