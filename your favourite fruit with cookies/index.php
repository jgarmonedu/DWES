<?php
/**
 * DWES - 2º DAW - IES Virgen del Carmen de Jaén
 *
 * Ejercicio basado en: Cookies 1
 * https://www.mclibre.org/consultar/php/ejercicios/sesiones/cookies/cookies-1a.php
 *
 * @author    Javier García Montero
 * @copyright 2023 Javier García Montero
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2023-10-27
 * @link      http://www.mclibre.org
 */
// Para usar las funciones cabecera y pie
include_once 'functions.php';

$url = htmlentities($_SERVER['PHP_SELF']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {         // POST
    $fruit = isset($_POST['fruta']) ? htmlentities($_POST['fruta']) : '';
    if (!empty($fruit) && in_array($fruit,$fruits)) {
        head("FRUTA PREFERIDA 2 (RESULTADO)", "./css/style.css",
            "Estilo básico", "FRUTA PREFERIDA 2 (RESULTADO)");
        setcookie($cookie_name, $fruit, time() + (86400 * 30), "/");
        echo "<p>Esta es su fruta favorita:</p>\n";
        echo "<p><img src='images/".$fruit.".svg' width='300' alt=".$fruit."></p>\n";
        echo "<p><a href='index.php'> Volver al formulario</a></p>";
    } else {        // borrado de COOKIE
        head("Fruta preferida 2 (Formulario).", "./css/style.css",
            "Estilo básico", "FRUTA PREFERIDA 2 (FORMULARIO)");
        echo "<h3>No tiene ninguna favorita aún.</h3>";
        setcookie($cookie_name, "", time() - 3600, "/");
        form($url,$fruits);
    }
} else {        // GET
    head("Fruta preferida 2 (Formulario).", "./css/style.css",
        "Estilo básico", "FRUTA PREFERIDA 2 (FORMULARIO)");
    echo isset($_COOKIE[$cookie_name]) ? "<h3>Su fruta favorita es: ".htmlentities($_COOKIE[$cookie_name])."</h3>" : "<h3>No tiene ninguna favorita aún.</h3>";
    form($url,$fruits);
    echo isset($_COOKIE[$cookie_name]) ?  "<p> Si NO selecciona ninguna se borrará la fruta seleccionada</p>" : "";
}
// function pie($fecha)
foot(date('Y-m-d'));
?>
