<?php

namespace tugmaks\GoogleMaps;

use tugmaks\GoogleMaps\assets\FontAwesomeAsset;

class Map extends \yii\base\Widget {

    public function run() {
        FontAwesomeAsset::register($this->view);
        return "Hello!!!";
    }

}
