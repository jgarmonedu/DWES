<?php
$value = htmlentities($_GET['brand']);
if ($value=="") {
    echo "<p>No se han indicado ninguna marca</p>";
} else {
    require_once 'client.php';
    $client = new Client();
    $brand = $client->getBrandById($value);
    $models = $client->getModelsByBrand($value);
    echo "<h1 class='heading'> Modelos disponibles marca: ". $brand['marca']." </h1>";
    if (empty($models)) {
        echo "<div class='alert alert-danger' role='alert''>";
        echo "<h2> No hay modelos disponibles para esa marca </h2>";
        echo "</div>";
    } else {
        echo "<div class='accordion' id='accordionFlush'>";
        foreach ($models as $key => $model) {
            echo "<div class='accordion-item'>";
            echo "<figure class='accordion-header'>";
            echo "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse".$key."' aria-expanded='false' aria-controls='flush-collapse".$key."'>";
            echo "<figcaption>".strtoupper($model['modelo'])."</figcaption>";
            echo "</button>";
            echo "</figure>";
            echo $key==0 ? "<div id='flush-collapse".$key."' class='accordion-collapse collapse show' data-bs-parent='#accordionFlush'>" : "<div id='flush-collapse".$key."' class='accordion-collapse collapse' data-bs-parent='#accordionFlush'>" ;
                echo "<div class='accordion-body'><h4 ><a class='button style2 fit' href='https://es.wikipedia.org/wiki/".$brand['marca']."_".$model['modelo']."'>Información</a></h4><img src='images/".strtolower($brand['marca']).".jpg' alt='logo ".strtolower($brand['marca'])."'></div>";
            echo " </div>";
            echo " </div>";
        }
        echo " </div>";
    }
}