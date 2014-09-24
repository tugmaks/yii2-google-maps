<?php

namespace tugmaks\GoogleMaps;

use tugmaks\GoogleMaps\assets\FontAwesomeAsset;

class Map extends \yii\base\Widget {

    public $sensor = false;

    public function init() {
        $api_key = Yii::$app->params()['GOOGLE_KEY_API'];
        $this->view->registerJsFile('https://maps.googleapis.com/maps/api/js?key=' . $api_key . '&sensor=' . $this->sensor);
        FontAwesomeAsset::register($this->view);
        parent::init();
    }

    public function run() {

        return "Hello!!!";
    }

}
