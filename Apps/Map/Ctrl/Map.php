<?php


namespace Apps\Map\Ctrl;


use Boom\Ctrl\Controller;
use Cake\ORM\TableRegistry;

class Map extends Controller
{
    function __construct($appname, $request, $response, array $params, $name)
    {
        $this->hasModel = false;
        parent::__construct($appname, $request, $response, $params, $name);
    }

    function action_main($params = null)
    {

        $model = TableRegistry::get('Map');
        $map = $model->find()->first();
        return $this->view('map', ['map' => $map]);
    }

}