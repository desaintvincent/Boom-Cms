<?php
namespace Apps\Catalogue\Ctrl;

use Boom\Ctrl\Controller;

class Categories extends Controller
{
    function exist($name)
    {
        //c'est du statique c'est moche
    }

    public function action_main($params)
    {
        if (empty($params) || empty($params[0])) {
            // Liste les catégories
            return $this->list_categories();
        } else {
            // Liste les produits de la catégorie $params[0]
            return $this->list_category_products($params[0]);
        }
    }

    public function list_categories()
    {
        $categories = $this->Categorie->find();

        $this->view('categories/list', compact('categories'));
    }

    public function list_category_products($category)
    {
        $this->loadModel('Product');

        $products = $this->Product->find('all', [
            "joins" => [
                "categories"
            ],
            "where" => [
                "categories.slug" => $category
            ]
        ]);
        $this->view('categories/view', compact('products'));
    }
}