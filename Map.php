<?php

namespace tugmaks\GoogleMaps;

use Yii;

class Map extends \yii\base\Widget {

    public $sensor = false;

    public function init() {
        $api_key = Yii::$app->params['GOOGLE_API_KEY'];
        $sensor = $this->sensor ? 'true' : 'false';
        $this->view->registerJsFile('https://maps.googleapis.com/maps/api/js?key=' . $api_key . '&sensor=' . $sensor);
        parent::init();
    }

    public function run() {

        return $this->render('map');
    }

}
