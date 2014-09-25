<?php

namespace tugmaks\GoogleMaps;

use Yii;

class Map extends \yii\base\Widget {

    const MAP_TYPE_ROADMAP = 'ROADMAP';
    const MAP_TYPE_HYBRID = 'HYBRID';
    const MAP_TYPE_SATELLITE = 'SATELLITE';
    const MAP_TYPE_TERRAIN = 'TERRAIN';

    public $sensor = false;
    public $width = 600;
    public $height = 600;
    public $center = 'г. Москва, ул. Г. Королёва, д.12';
    public $zoom = 4;
    public $mapType = 'ROADMAP';
    public $markers = [];
    public $apiKey;

    public function init() {
        $this->apiKey = Yii::$app->params['GOOGLE_API_KEY'];
        $this->sensor = $this->sensor ? 'true' : 'false';
        /* $this->view->registerJs('
          var geocoder, map;
          function initialize() {
          geocoder = new google.maps.Geocoder();
          geocoder.geocode({
          "address": "' . $this->center . '"
          }, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
          var myOptions = {
          zoom: ' . $this->zoom . ',
          center: results[0].geometry.location,
          mapTypeId: google.maps.MapTypeId.' . $this->mapType . '
          }
          map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

          var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
          });
          }
          });
          }
          function loadScript() {
          var script = document.createElement("script");
          script.type = "text/javascript";
          script.src = "https://maps.googleapis.com/maps/api/js?key=' . $api_key . '&sensor=' . $sensor . '&callback=initialize";
          document.body.appendChild(script);
          }

          window.onload = loadScript;', \yii\web\View::POS_END); */
        parent::init();
    }

    public function run() {

        return $this->render('map');
    }

}
