<?php

function head($titulo, $estilo, $tituloCSS, $tituloh1) {
    echo <<< CABECERA
    <!DOCTYPE html>
    <html lang='es'>
      <head>
        <meta charset='utf-8'>
        <title>$titulo</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='icon' type='image/png' href='images/favicon.png'>
        <link href='$estilo' rel='stylesheet' type='text/css' title='$tituloCSS'>
      </head>
      <body>
        <h1>$tituloh1</h1>
CABECERA;
}

function foot($fecha) {
    $cadenaFecha = formatDate($fecha);
    echo <<< PIE
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
PIE;
}
function formatDate($fecha)
{
    define('formatoFecha', '%d de %B de %Y');
    setlocale(LC_ALL, 'es_ES.UTF-8');
    return strftime(formatoFecha, strtotime($fecha));
}

?>