<?php

namespace tugmaks\GoogleMaps;

use Yii;

class Map extends \yii\base\Widget
{
    const API_URL = '//maps.googleapis.com/maps/api/js?';

    const MAP_TYPE_ROADMAP   = 'ROADMAP';
    const MAP_TYPE_HYBRID    = 'HYBRID';
    const MAP_TYPE_SATELLITE = 'SATELLITE';
    const MAP_TYPE_TERRAIN   = 'TERRAIN';
    const UNITS_PX           = 'px';
    const UNITS_PERCENT      = '%';
    const UNITS_EM           = 'em';
    const UNITS_REM          = 'rem';
    const UNITS_VH           = 'vh';
    const UNITS_VW           = 'vw';


    public $sensor          = false;
    public $width           = 600;
    public $height          = 600;
    public $widthUnits      = self::UNITS_PX;
    public $heightUnits     = self::UNITS_PX;
    public $center          = 'г. Москва, ул. Г. Королёва, д.12';
    public $zoom            = 16;
    public $mapType         = 'ROADMAP';
    public $markers         = [];
    public $apiKey          = null;
    public $markerFitBounds = false;
    public $id              = null;
    public $loadAssets      = true;
    public $language        = 'en';
    public $scrollwheel     = true;

    /**
     * DESC
     *
     * @return void
     */
    public function init()
    {
        if ($this->apiKey === null) {
            $this->apiKey = Yii::$app->params['GOOGLE_API_KEY'];
        }
        $this->sensor = $this->sensor ? 'true' : 'false';
        parent::init();
    }

    /**
     * DESC
     *
     * @return mixed
     *
     */
    public function run()
    {
        $view = $this->getView();

        $view->registerJsFile(self::API_URL . http_build_query([
                'sensor'   => $this->sensor ? 'true' : 'false',
                'language' => $this->language,
                'key'      => $this->apiKey,
                'callback' => 'initialize_' . md5($this->id),
            ]), ['position' => $view::POS_END]);

        return $this->render('map');
    }

}
