<?php
namespace Apps\Catalogue\Model;

use Boom\Model\Model;

class Product extends Model {

    public $joins = [
        "categories" => "prod_category_id"
    ];

}