<?php
namespace Apps\Catalogue\Model;

use Apps\Catalogue\Model\Entities\ProductEntity;
use Cake\ORM\Table;

class ProductsTable extends Table
{

    public function initialize(array $config)
    {
        $this->entityClass(ProductEntity::class);
        $this->belongsTo('Categories');
    }

}