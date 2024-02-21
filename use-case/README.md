## Pusher Use-case quick starts
### Mashup (web application hybrid) with pusher implementation

Loading content to suscription throw WebSockets with Pusher
Is necessary to put the **personal API Key** information.

```php
$pusher = new Pusher\Pusher(
    "API_KEY", // Replace with 'key' from dashboard
    "SECRET", // Replace with 'secret' from dashboard
    "APP_ID", // Replace with 'app_id' from dashboard
    array(
        'cluster' => 'CLUSTER' // Replace with 'cluster' from dashboard
    )
);
```

File **population.php** add data to pusher subscription and **index.html** receives from subscription tha data updated.

More information [Pusher WebSocket](https://pusher.com/websockets/)

[Real Time Data sorting](https://www.amcharts.com/demos/real-time-data-sorting/). The result is showed in the following image:

![Real Time Data sorting](https://www.amcharts.com/wp-content/uploads/2020/02/demo_15137_none-1-1024x690.png)
The Graph is made with [amcharts](https://www.amcharts.com/) javascript library.

`<script src="https://cdn.amcharts.com/lib/5/index.js"></script>`

`<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>`

`<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>`