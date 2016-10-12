<?php
namespace Apps\Catalogue\Model;


use Apps\Catalogue\Model\Entities\CategoryEntity;
use Cake\ORM\Table;

class CategoriesTable extends Table
{

    public function initialize(array $config)
    {
        $this->entityClass(CategoryEntity::class);
    }
}