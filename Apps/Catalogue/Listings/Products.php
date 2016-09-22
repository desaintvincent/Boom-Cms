<?php

return [
    'name' => __('Listing des produits'),
    'model' => 'Product',
    'fields' => [
        'prod_title' => 'Titre du produit'
    ],
    'add_item' => [
        [
            'appname' => 'catalogue',
            'crud' => 'categorie',
            'name' => __('Ajouter une catégorie')
        ],
        [
            'appname' => 'catalogue',
            'crud' => 'product',
            'name' => __('Ajouter un produit')
        ]
    ]
];