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
Parameters
Name  | Description
------------- | -------------
zoom  | integer, not required, default 4
center  | array or string. If array lat and lng will be used, if string search query will be used. For example 'center'=>[23.091,100.412] or 'center'=>'London, UK'
width | integer, size in px of div wrapper width
height | integer, size in px of div wrapper height
mapType | string, one of this: MAP_TYPE_ROADMAP, MAP_TYPE_HYBRID, MAP_TYPE_SATELLITE, MAP_TYPE_TERRAIN