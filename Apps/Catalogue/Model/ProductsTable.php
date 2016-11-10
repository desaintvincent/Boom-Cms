<?php
namespace Apps\Catalogue\Model;

use Apps\Catalogue\Model\Entities\ProductEntity;
use Boom\Model\Model;

class ProductsTable extends Model
{

    public function initialize(array $config)
    {
        $this->entityClass(ProductEntity::class);
        $this->belongsTo('Categories');
    }

}