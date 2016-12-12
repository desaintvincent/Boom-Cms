<?php
namespace Apps\Maps\Model;

use Apps\Maps\Model\Entities\MapEntity;
use Boom\Model\Model;

class MapsTable extends Model {
    public function initialize(array $config)
    {
        $this->entityClass(MapEntity::class);
        $this->hasMany('MapCircles', [
            'className' => 'MapCircles',
            'foreignKey' => 'map_id',
            'bindingKey' => 'id'
        ]);
    }
}