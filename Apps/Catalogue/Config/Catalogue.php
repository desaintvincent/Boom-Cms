<?php
return [
    'required' => false,
    'default_ctrl' => 'categories',
    'default_crud' => 'product',
    'default_listing' => 'products', // Required
	'enhancers' => [
		'list_categories' => [
			'name' => 'Liste les catégories',
            'controller' => 'categories',
			'action' => 'categories'
		],
		'list_products_category' => [
			'name' => 'Liste les produits d \'une catégorie' ,
            'controller' => 'categories',
			'action' => 'cat_products'
		]
	],
];