<?php
return [
    'required' => false,
    'default_ctrl' => 'categories',
    'default_crud' => 'product',
    'icon' => 'fa-book',
    'default_listing' => 'products', // Required
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
];