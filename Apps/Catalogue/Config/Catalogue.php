<?php
return [
    'required' => true,
    'default_ctrl' => 'categorie',
	'enhancers' => [
		'list_categories' => [
			'name' => 'Liste les catégories',
			'action' => 'categories'
		],
		'lsit_products_category' => [
			'name' => 'Liste les produits d\'une catégorie' ,
			'action' => 'cat_products'
		]
	]
];