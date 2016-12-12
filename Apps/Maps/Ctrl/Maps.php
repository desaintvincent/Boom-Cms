<?php


namespace Apps\Maps\Ctrl;


use Apps\Maps\Model\MapCirclesTable;
use Apps\Maps\Model\MapsTable;
use Boom\Ctrl\Controller;
use Cake\ORM\TableRegistry;

class Maps extends Controller
{
    function __construct($appname, $request, $response, array $params, $name)
    {
        $this->hasModel = false;
        parent::__construct($appname, $request, $response, $params, $name);
    }

    function action_main($params = null)
    {

  /*      $model = TableRegistry::get('MapCircles', [
            'className' => MapCirclesTable::class
        ]);
        $circles = $model->find()->contain(['Maps'])->first();
        dd($circles);
*/
        $model = TableRegistry::get('Maps',[
            'className' => MapsTable::class]);

        $map = $model->find()->contain(['MapCircles'])->matching('MapCircles')->first();
        return $this->view('map', ['map' => $map]);
    }

}