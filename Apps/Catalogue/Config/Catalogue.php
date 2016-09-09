<?php
return [
    'required' => true,
    'default_ctrl' => 'categories',
    'default_crud' => 'product',
	'enhancers' => [
		'list_categories' => [
			'name' => 'Liste les catégories',
            'controller' => 'categories',
			'action' => 'categories'
		],
		'lsit_products_category' => [
			'name' => 'Liste les produits d\'une catégorie' ,
            'controller' => 'categories',
			'action' => 'cat_products'
		]
	],
];