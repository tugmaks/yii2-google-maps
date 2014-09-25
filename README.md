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


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
use tugmaks\GoogleMaps\Map;

echo Map::widget([
    'zoom' => 16,
    'address' => 'Red Square',
    'width' => 700,
    'height' => 400,
    'mapType' => Map::MAP_TYPE_SATELLITE,
]);
```