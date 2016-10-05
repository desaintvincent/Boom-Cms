<?php
return [
    'required' => false,
    'default_ctrl' => 'categories',
    'default_crud' => 'products',
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
        'products' => [
            'name' => __('Listing des produits'),
            'model' => 'Products',
            'fields' => [
                'title' => 'Titre du produit'
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
        ],
        'categories' => [
            'name' => __('Listing des catégories'),
            'model' => 'Categories',
            'fields' => [
                'title' => 'Titre de la catégorie'
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