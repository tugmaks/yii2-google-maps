<?php

namespace tugmaks\GoogleMaps;

use Yii;

class Map extends \yii\base\Widget {

    public $sensor = false;

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
