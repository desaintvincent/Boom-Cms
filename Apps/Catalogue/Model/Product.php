<?php
namespace Apps\Catalogue\Model;

use Boom\Model\Model;

class Product extends Model {

    public $prefix = 'prod_';

    public $joins = [
        "categories" => "prod_category_id"
    ];

}