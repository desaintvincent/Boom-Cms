<?php
namespace Apps\Pages\Model;

use Apps\Pages\Model\Entities\PageEntity;
use Cake\ORM\Table;

class PagesTable extends Table {

    public function initialize(array $config)
    {
        $this->entityClass(PageEntity::class);
    }

}