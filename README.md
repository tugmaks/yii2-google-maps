Google Maps Yii2 wrapper
========================
Google Maps Yii2 wrapper

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist tugmaks/yii2-google-maps "*"
```

or add

```
"tugmaks/yii2-google-maps": "*"
```

to the require section of your `composer.json` file.


MUST READ
-----
[Google Maps JavaScript API v3](https://developers.google.com/maps/documentation/javascript/reference)

BASIC USAGE
-----
Once the extension is installed, simply use it in your code by  :

```php
use tugmaks\GoogleMaps\Map;

echo Map::widget([
    'zoom' => 16,
    'center' => 'Red Square',
    'width' => 700,
    'height' => 400,
    'mapType' => Map::MAP_TYPE_SATELLITE,
]);
```

There are two ways to set API KEY:

Add to application parameters.
```php
config/params.php

return [
.....
'GOOGLE_API_KEY' => 'VIza7yBgBzYEbKx09V566DhM8Ylc3NjWsJ0ps-2' // use your own api key
.....
]
```
Or pass it direct to widget. 

```php
use tugmaks\GoogleMaps\Map;

echo Map::widget([
    'apiKey'=> 'VIza7yBgBzYEbKx09V566DhM8Ylc3NjWsJ0ps-2',
    'zoom' => 3,
    'center' => [20, 40.555],
    'width' => 700,
    'height' => 400,
    'mapType' => Map::MAP_TYPE_HYBRID,
]);
```

Parameters

| Name  | Description |
| ------------- | ------------- |
| zoom  | integer, not required, default 16 |
| center  | array or string, required. If array lat and lng will be used, if string search query will be used. For example: ```php 'center'=>[23.091,100.412] ``` or ```php 'center'=>'London, UK' ``` |
| width | integer, not required, default 600. Size in px of div wrapper width |
| height | integer, not required, default 600. Size in px of div wrapper height |
| mapType | string, not required, default ROADMAP. Available types: MAP_TYPE_ROADMAP, MAP_TYPE_HYBRID, MAP_TYPE_SATELLITE, MAP_TYPE_TERRAIN |
| markers | array, not required. Markers that will be added to map|

MARKERS
-----

One or more marker can be added to map. Just pass marker array to widget config

```php
use tugmaks\GoogleMaps\Map;

echo Map::widget([
    'zoom' => 5,
    'center' => [45, 45],
    'width' => 1100,
    'height' => 600,
    'mapType' => Map::MAP_TYPE_HYBRID,
    'markers' => [
        ['position' => 'Erevan'],
        ['position' => 'Moscow'],
        ['position' => 'Ankara'],
        ['position' => 'Kazan'],
        ['position' => 'Sofia'],
    ]
]);
````

MARKERS FIT BOUNDS
-----

Sometimes you need to show all markers on map, but do not know initial map center and zoom. In this case use widget like this

```php
use tugmaks\GoogleMaps\Map;

echo Map::widget([
    'center' => [45, 45], // write whatever you want here, but still required
    'width' => 1100,
    'height' => 600,
    'mapType' => Map::MAP_TYPE_HYBRID,
    'markers' => [
        ['position' => 'Erevan'],
        ['position' => 'Moscow'],
        ['position' => 'Ankara'],
        ['position' => 'Kazan'],
        ['position' => 'Sofia'],
    ],
    'markerFitBounds'=>true
]);