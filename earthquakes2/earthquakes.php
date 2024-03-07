<?php

$earthquakes = simplexml_load_file("http://www.ign.es/ign/RssTools/sismologia.xml");
$json = array();

foreach ($earthquakes->channel[0]->item as $earthquake) {
    $title = explode(" ",$earthquake->title);
    $description = explode(" ",$earthquake->description);
    $partial = substr($earthquake->description , 48);
    $location = substr($partial, 0, (stripos($partial, 'en la')-1));

    $data[] = array (
            "date" => $title[1],
            "time" => $title[2],
            "link" => $earthquake->link->__toString(),
            "description" => $earthquake->description->__toString(),
            "magnitude" => $description[7],
            "location" =>  $location,
            "lat" => $earthquake->children("http://www.w3.org/2003/01/geo/wgs84_pos#")->lat->__toString(),
            "long" => $earthquake->children("http://www.w3.org/2003/01/geo/wgs84_pos#")->long->__toString(),
    );
}
print_r(json_encode($data));

