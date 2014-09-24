<?php

namespace tugmaks\GoogleMaps;

use Yii;

class Map extends \yii\base\Widget {

    public $sensor = false;
    public $width = 600;
    public $height = 600;
    public $address = 'г. Казань, ул. Г. Камала, д.41';

    public function init() {
        $api_key = Yii::$app->params['GOOGLE_API_KEY'];
        $sensor = $this->sensor ? 'true' : 'false';
        //$this->view->registerJsFile('https://maps.googleapis.com/maps/api/js?key=' . $api_key . '&sensor=' . $sensor);
        $this->view->registerJs('function initialize() {
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(-34.397, 150.644),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
  codeAddress("' . $this->address . '");
}
function codeAddress(address) {
geocoder = new google.maps.Geocoder();
    geocoder.geocode( { "address": address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
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

window.onload = loadScript;', \yii\web\View::POS_END);
        parent::init();
    }

    public function run() {

        return $this->render('map');
    }

}
