<?php
namespace Apps\Map\Model;

use Apps\Map\Model\Entities\MapEntity;
use Apps\Pages\Model\Entities\PageEntity;
use Boom\Model\Model;

class MapCircleTable extends Model {
    public function initialize(array $config)
    {
        $this->entityClass(MapEntity::class);
        //$this->belongsTo('Map');
    }
}