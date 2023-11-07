<?php 
/**
 * DWES - 2º DAW - IES Virgen del Carmen de Jaén
 *
 * Ejercicio basado en: Cookies 1 - cookies_1a.php
 * https://www.mclibre.org/consultar/php/ejercicios/sesiones/cookies/cookies-1a.php
 *
 * @author    Javier García Montero
 * @copyright 2023 Javier García Montero
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2023-10-23
 * @link      http://www.mclibre.org
 */

// Para usar las funciones cabecera y pie
require_once 'functions.php';
$fruta = isset(array_keys($_POST)[0]) ? str_replace("_x", "",array_keys($_POST)[0]): '';
$fruta = htmlentities($fruta);
// Si se establece un fruta se crea la cookie con el valor correspondiente $fruta
if (in_array($fruta,$fruits)) {
    setcookie($cookie_name, $fruta, time() + (86400 * 30), "/");
// Si se elige fruta ninguno se borra la cookie frutaUsuario
} elseif ($fruta=='none') {
    setcookie ($cookie_name, "", time() - 3600, "/");
// Si no se elige fruta se comprueba si ya existe la cookie frutaUsuario y se guarda en $fruta
} else {
     $fruta = isset($_COOKIE[$cookie_name]) ? htmlentities($_COOKIE[$cookie_name]) : '';
}

// function cabecera($titulo, $estilo, $tituloCSS, $textoh1)
head("Ejemplo de uso de Cookies - Elegir fruta A", "css/style.css",
    "Estilo básico", "Ejemplo de uso de Cookies (Elegir fruta)");

// Mostrar mensaje respecto al valor de $fruta
if ($fruta=='none' || $fruta=='') {
    print "<h2>No se ha seleccionado ningún fruta.</h2>\n";
} else { 
    print "<h2>Ha elegido la fruta: $fruta.</h2>\n";
}

$url = htmlentities($_SERVER['PHP_SELF']);
print "<p>Cambio de fruta:</p>";
print "<form action=\"$url\" method=\"POST\" enctype=\"multipart/form-data\">";
foreach ($fruits as $f) {
    print "<input type=\"image\" name=\"$f\" src=\"images/".$f.".svg\" height=\"50\" alt=\"$f\" title=\"$f\">\n\t";
}
print "<input type=\"image\" name=\"none\" src=\"images/none_50px.png\" alt=\"Ninguno\" title=\"Ninguno\">(se borra la cookie $cookie_name)\n\t";
print "</form>";
print "<p><a href=\"cookie_fruta_B.php\">Ir a otra página para comprobar la cookie</a></p>";

// function pie($fecha)
foot(date('Y-m-d'));
?>
