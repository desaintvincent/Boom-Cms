<?php
namespace Apps\Maps\Model;

use Apps\Maps\Model\Entities\MapCircleEntity;
use Boom\Model\Model;

class MapCirclesTable extends Model {
    public function initialize(array $config)
    {
        $this->entityClass(MapCircleEntity::class);
        $this->belongsTo('Maps', [
            'className' => 'Maps',
            'foreignKey' => 'map_id',
            'bindingKey' => 'id'
        ]);
    }
}