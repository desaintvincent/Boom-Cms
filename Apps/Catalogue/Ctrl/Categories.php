<?php
namespace Apps\Catalogue\Ctrl;

use Boom\Ctrl\Controller;

class Categories extends Controller
{
    function exist($name)
    {
        //c'est du statique c'est moche
    }

    public function action_main($params = NULL)
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
        $categories = $this->Categories->find();

        $this->view('categories/list', compact('categories'));
    }

    public function list_category_products($category_slug)
    {
        $this->loadModel('Products');

        $category = $this->Categories->find()->where(['slug' => $category_slug])->first();
        if (!empty($category)) {
            $products = $this->Products->find('all', [
                "contain" => ['Categories'],
                "where" => [
                    "Categories.slug" => $category_slug
                ]
            ]);
            $this->view('categories/view', compact('products', 'category'));
        } else {
            dd('la catégorie existe pas');
        }

    }
}