<?php
include_once ("functions.php");
session_name('memorion');
session_start();

// Si no están definidas las variables de sesión, redirigimos a la segunda página
if (!isset($_SESSION["numImages"]) || !isset($_SESSION["images"])) {
    header("Location:memorion.php");
    exit;
}

head('Memorión. Sesiones','css/style.css','Estilo estándar','Configurar Juego');

?>

<form action="check.php" method="post">
    <p>Indique el número de figuras distintas a mostrar:</p>
    <p><input name="numberImages" type="number" value="<?=$_SESSION['numImages']?>" min="2" max="61"></p>
    <p>
        <button type="submit" name="update" value="update">Actualizar</button>
        <button type="reset" name="reset" value="reset">Reiniciar</button>
    </p>
</form>
<?php
foot(date("Y-m-d"));
?>
