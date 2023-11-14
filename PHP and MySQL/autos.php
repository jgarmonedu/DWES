<?php
require_once ('pdo.php');
if (isset($_POST['logout'])) {
    header('Location: index.php');
}
if (!isset($_GET['name']) || strlen($_GET['name'])<1){
    die("Name parameter missing");
}

$result = "";

if (isset($_POST['add'])) {
    if (!is_numeric(htmlentities($_POST['year'])) || !is_numeric(htmlentities($_POST['mileage']))){
        $result = "<p style=\"color: red;\">Mileage and year must be numeric</p>";
    } elseif (strlen(htmlentities($_POST['make']))<1){
        $result =  "<p style=\"color: red;\">Make is required</p>";
    } else { // data passes validation
       try {
            $stmt = $pdo->prepare("INSERT INTO autos (make, year, mileage) VALUES ( :mk, :yr, :mi);");
            $stmt->execute(array(
                ':mk' => htmlentities($_POST['make']),
                ':yr' => htmlentities($_POST['year']),
                ':mi' => htmlentities($_POST['mileage']))
            );
       } catch (Exception $ex) {
            echo("Exception message: ".$ex->getMessage());
            return;
       }
       $result = "<p style=\"color: green;\">Record inserted</p>";
    }
}
// query all rows from table auto
$stmt = $pdo->query("SELECT * FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Javier Garcia's Automobile Tracker 8735d8e3</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Tracking Autos for <?= $_GET['name'] ?></h1>
    <?= $result ?>
    <form method="post">
        <p>Make:
            <input type="text" name="make" size="60"/></p>
        <p>Year:
            <input type="text" name="year"/></p>
        <p>Mileage:
            <input type="text" name="mileage"/></p>
        <input type="submit" name="add" value="Add">
        <input type="submit" name="logout" value="Logout">
    </form>
    <h2>Automobiles</h2>
    <ul>
        <?php
        if (isset($rows) && !empty($rows)) { // if rows have registers
            foreach ($rows as $row) {
                echo "<li>".$row['year']." ".$row['make']." / ".$row['mileage']."</li>";
            }
        }
        ?>
    </ul>
</div>
</body>
</html>