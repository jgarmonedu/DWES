<?php
session_name('memorion');
session_start();
// Si no están definidas las variables de sesión, las definimos
if (!isset($_SESSION['numImages'])) {
    $_SESSION['numImages'] = 5;
}

if (!isset($_SESSION['intends'])) {
    $_SESSION['intends'] = 0;
}

if (!isset($_SESSION['images'])) {
    // Matriz con todos los valores posibles (61 valores)
    $valueImages = range(128000, 128060);
    // Los barajamos
    shuffle($valueImages);
    for ($i = 0; $i < $_SESSION['numImages']; $i++) {
        $_SESSION['images'][$i] = $valueImages[$i];
    }
    // Duplicamos los valores (creamos valores de N a 2N-1)
    for ($i = 0; $i < $_SESSION['numImages']; $i++) {
        $_SESSION['images'][$_SESSION['numImages'] + $i] = $valueImages[$i];
    }
    // Los barajamos de nuevo
    shuffle($_SESSION['images']);

    // Guardamos las fichas boca abajo
    for ($i = 0; $i < 2 * $_SESSION['numImages']; $i++) {
        $_SESSION['size'][$i] = "back";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = isset($_POST['action']) ? htmlentities($_POST['action']) : '';
    $round = isset($_POST['round']) ? htmlentities($_POST['round']) : '';
    if ($action=='new') {
        // ... borramos la partida actual
        unset($_SESSION['images']);
        unset($_SESSION['intends']);
        // ... y redirigimos a la primera página
        header("Location:index.php");
        exit;
    }
    if ($action=='change') {
        header("Location:configuration.php");
        exit;
    }

    // Si se ha pulsado una ficha que está boca abajo ..
    if ($_SESSION['size'][$round] == "back") {
        // ... la giramos
        $_SESSION['size'][$round] = "image";
        // Si no hay ninguna ficha girada ...
        if ($_SESSION['first'] == -1) {
            // ... guardamos qué ficha hemos girado
            $_SESSION['first'] = $round;
            // Si hay sólo una ficha girada ...
        } elseif ($_SESSION['first'] != -1 && $_SESSION['second'] == -1) {
            // ... guardamos qué ficha hemos girado
            $_SESSION['second'] = $round;
            $_SESSION['intends'] += 1;
        } elseif ($_SESSION['first'] != -1 && $_SESSION['second'] != -1) {
            // Si son diferentes
            if ($_SESSION['images'][$_SESSION['first']] != $_SESSION['images'][$_SESSION['second']]) {
                // ... damos la vuelta a las dos fichas anteriores
                $_SESSION['size'][$_SESSION['first']] = "back";
                $_SESSION['size'][$_SESSION['second']] = "back";
            }
            // Y guardamos esa ficha como primera ficha de la jugada siguiente
            $_SESSION['first'] = $round;
            $_SESSION['second'] = -1;
        }
    }
}
header("Location:index.php");

?>