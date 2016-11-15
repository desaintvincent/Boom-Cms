<?php
namespace Apps\MainConfig\Model;

use Apps\MainConfig\Model\Entities\MainConfigEntity;
use Apps\Pages\Model\Entities\PageEntity;
use Boom\Model\Model;

class MainConfigTable extends Model {
    public function initialize(array $config)
    {
        $this->entityClass(MainConfigEntity::class);
    }
}