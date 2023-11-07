<?php
include_once ("functions.php");
session_name('memorion');
session_start();

// Si no están definidas las variables de sesión, redirigimos a la segunda página
if (!isset($_SESSION['numImages']) || !isset($_SESSION['images'])) {
    header("Location:memorion.php");
    exit;
}

head('Memorión. Sesiones','css/style.css','Estilo estándar','Memorión (1)');
?>

<form action="memorion.php" method="post">
    <button type="submit" name="action" value="new">Nueva Partida</button>
    <button type="submit" name="action" value="change">Cambiar número de dibujos</button>
    <br><br>
    <?php
    for ($i=0; $i<2*$_SESSION['numImages']; $i++) {
        // La ficha puede estar boca arriba (se ve el dibujo del animal) ...
        if ($_SESSION['size'][$i] == "image") {
            print "      <button type=\"submit\" name=\"round\" value=\"$i\" style=\"font-size: 70px; width: 100px; height: 100px;\">&#{$_SESSION["images"][$i]};</button> \n";
        } else { // ... o boca abajo (se ve el dibujo del dorso)
            print "      <button type=\"submit\" name=\"round\" value=\"$i\" style=\"font-size: 70px; width: 100px; height: 100px; color: black;\">&#10026;</button> \n";
        };
    };
    ?>
</form>
<?php
// Mostramos el número de jugadas realizadas
print "    <p>Jugadas realizadas: ". $_SESSION['intends'] . "</p>\n";
foot(date("Y-m-d"));
?>
