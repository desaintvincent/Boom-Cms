<?php
return [
    'required' => false,
    'default_ctrl' => 'categories',
    'default_crud' => 'product',
    'icon' => 'fa-book',
    'default_listing' => 'products', // Required


    'name' => __('Produit'),
    'title' => 'prod_title',


	'enhancers' => [
		'list_categories' => [
		    'appname' => 'catalogue',
			'name' => 'Liste les catégories',
            'controller' => 'categories',
			'action' => 'categories'
		],
		'list_products_category' => [
            'appname' => 'catalogue',
			'name' => 'Liste les produits d\'une catégorie' ,
            'controller' => 'categories',
			'action' => 'main'
		]
	],



    'appdesk' => [
        'product' => [
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
        ]
    ]
];