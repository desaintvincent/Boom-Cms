<?php
namespace Apps\Catalogue\Model;


use Cake\ORM\Table;

class CategoriesTable extends Table {

    public function initialize(array $config)
    {
        $this->entityClass(MenuEntity::class);
    }
}