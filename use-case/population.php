<?php
// First, run 'composer require pusher/pusher-php-server'
require __DIR__ . '/vendor/autoload.php';

$pusher = new Pusher\Pusher(
    "API_KEY", // Replace with 'key' from dashboard
    "SECRET", // Replace with 'secret' from dashboard
    "APP_ID", // Replace with 'app_id' from dashboard
    array(
        'cluster' => 'CLUSTER' // Replace with 'cluster' from dashboard
    )
);
// Trigger a new random event every second. In your application,
// you should trigger the event based on real-world changes!
// Set data
while (true) {
    $pusher->trigger('population', 'new-population', array(
        [
            "country" => "USA",
            "value" => 2025 + rand(-200,200)
        ],[ "country"=> "China",
            "value"=> 1882 + rand(-200,200)
        ],[ "country"=> "Japan",
            "value"=> 1809 + rand(-200,200)
        ],[ "country"=> "Germany",
            "value"=> 1322 + rand(-200,200)
        ],[ "country"=> "UK",
            "value"=> 1122 + rand(-200,200)
        ],[ "country"=> "France",
            "value"=> 1114 + rand(-200,200)
        ],[ "country"=> "India",
            "value"=> 984 + rand(-200,200)
        ],[ "country"=> "Spain",
            "value"=> 711 + rand(-200,200)
        ],[ "country"=> "Netherlands",
            "value"=> 665 + rand(-200,200)
        ],[ "country"=> "South Korea",
            "value"=> 443 + rand(-200,200)
        ],[ "country"=> "Canada",
            "value"=> 441 + rand(-200,200)
        ]
    ));
    sleep(1);
}

