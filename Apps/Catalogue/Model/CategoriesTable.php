<?php
namespace Apps\Catalogue\Model;


use Apps\Catalogue\Model\Entities\CategoryEntity;
use Boom\Model\Model;

class CategoriesTable extends Model
{

    public function initialize(array $config)
    {
        $this->entityClass(CategoryEntity::class);
    }
}