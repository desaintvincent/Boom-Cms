<?php
namespace Apps\Catalogue\Model;

use Cake\ORM\Table;

class Product extends Table {

    public function initialize(array $config)
    {
        $this->entityClass(MenuEntity::class);
        $this->hasMany('categories');
    }

}