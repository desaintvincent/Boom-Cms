<?php
namespace Apps\Catalogue\Model;


use Cake\ORM\Table;

class Categorie extends Table {
    public $prefix = "cat_";

    public function initialize(array $config)
    {
        $this->entityClass(MenuEntity::class);
    }
}