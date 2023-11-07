<?php
// Funciones para cookie_fruta_A.php
//                cookie_fruta_B.php
/*
   $titulo de la página etiqueta <title> en <head>
   $estilo nombre de la hoja de estilo, fichero css
   $tituloCSS nombre del estilo css
   $textoh1 texto a incluir dentro de la etiqueta <h1> al comienzo de la página
*/

$fruits = array ("cerezas","fresa","limon","manzana","naranja","pera");
$cookie_name = "frutaFavorita";
function head($titulo, $estilo, $tituloCSS, $textoh1) {
    print "<!DOCTYPE html>
<html lang='es'>
  <head>
    <meta charset='utf-8'>
    <title>$titulo</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link href='$estilo' rel='stylesheet' type='text/css' title='$tituloCSS'>
    <link rel='icon' href='images/favicon.ico'>
  </head>
  <body>
    <h1>$textoh1</h1>\n";
}

function form($url, $array) {
    echo "
    <form action='".$url."' method='post'>
        <p>Indique su fruta preferida:<br>\n\t";
    foreach ($array as $f) {
        echo "\t\t<label><input type='radio' name='fruta' value=$f>$f</label><br>\n\t";
    }
    echo "\t</p>
        <p>
          <input type='submit' value='Enviar'>
          <input type='reset' value='Borrar'>
        </p>
    </form>";
}

/*
   $fecha de última modificación de la página que realiza la llamada
   aaaa-mm-dd
*/
function foot($fecha) {
    $cadenaFecha = formatDate($fecha);
    echo <<< FINPIE
    <footer>
      <p class="ultmod">
        Última modificación de esta página:
        <time datetime="$fecha">$cadenaFecha</time></p>
      <p class="licencia">
        Este ejemplo utiliza código PHP del curso <strong><a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a></strong> por <a href="http://www.mclibre.org/" rel="author">Javier García Montero</a>.<br>
        El programa PHP que genera esta página se distribuye bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
        <p>Autor pictogramas: <a href="http://www.palao.es/">Sergio Palao</a> 
        Procedencia: <a href="https://arasaac.org/">ARASAAC</a>  
        Licencia: <a href="http://creativecommons.org/licenses/by-nc-sa/3.0/es/">CC (BY-NC-SA)</a> 
        </p>
    </footer>
  </body>
</html>
FINPIE;
}


/*
   $fecha en formato "aaaa-mm-dd" se pasa a "dd de mes de aaaa"

   Configuración de fruta, para que el mes salga en español
   http://php.net/manual/es/function.setlocale.php

   strftime — Formatea una fecha/hora local según una configuración local
   http://php.net/manual/es/function.strftime.php

   strtotime — Convierte una descripción de fecha/hora textual en Inglés a una fecha Unix
   http://php.net/manual/es/function.strtotime.php
*/

function formatDate($fecha) {
    define('formatoFecha', '%d de %B de %Y');
    setlocale(LC_ALL, 'es_ES.UTF-8');
    return strftime(formatoFecha, strtotime($fecha));
}
