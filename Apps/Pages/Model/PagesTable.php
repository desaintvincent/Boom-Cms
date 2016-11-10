<?php
namespace Apps\Pages\Model;

use Apps\Pages\Model\Entities\PageEntity;
use Boom\Model\Model;

class PagesTable extends Model {

    public function initialize(array $config)
    {
        $this->entityClass(PageEntity::class);
    }
}