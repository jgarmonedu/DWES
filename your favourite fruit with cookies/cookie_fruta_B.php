<?php
/**
 * DWES - 2º DAW - IES Virgen del Carmen de Jaén
 *
 * Ejercicio basado en: Cookies 1 - cookies_1b.php
 * https://www.mclibre.org/consultar/php/ejercicios/sesiones/cookies/cookies-1b.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2010 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2010-05-09
 * @link      http://www.mclibre.org
 */

// Para usar las funciones cabecera y pie 
require_once 'functions.php';

// Comprobar valor de la cookie frutaUsuario
// Si está definida la cookie frutaUsuario se guarda su valor en $fruta
// si no está definida la coookie frutaUsuario se guarda la cadena vacía en $fruta

$fruta = isset($_COOKIE[$cookie_name]) ? htmlentities($_COOKIE[$cookie_name]) : '';


// function cabecera($titulo, $estilo, $tituloCSS, $textoh1)
head("Ejemplo de uso de Cookies - Elegir fruta B","css/style.css",
	"Estilo básico", "Comprobando la cookie ($cookie_name)");
		 
// Texto del mensaje según el fruta seleccionado
// $alt para el atributo alt y title de la imagen de cada bandera

if (in_array($fruta,$fruits)) {
	$texto="Ha elegido el fruta $fruta";
} else {
	$texto="No se ha elegido ningún fruta.";
}

print "<h2 id=\"mensaje\">$texto</h2>\n";

// Si hay algún fruta elegido se muestra la bandera
if ($fruta!='') {
  print "<p class=\"fruta\"><img src=\"images/".$fruta.".svg\" alt=\"".$fruta."\" title=\"".$fruta."\"></p>\n";
}

print "<p><a href=\"cookie_fruta_A.php\">Volver a la selección de fruta</a></p>\n";

// function pie($fecha)
foot(date('Y-m-d'));
?>
