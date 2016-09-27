<?php
return [
    'required' => true,
    'icon' => 'fa-bars',
    'default_ctrl' => 'menu',
    'default_listing' => 'menu',


    'name' => __('Menu'),
    'title' => 'title',

    'appdesk' => [
        'menu' => [
            'name' => __('Listing des menus'),
            'model' => 'Menu',
            'fields' => [
                'title' => 'Titre du menu'
            ],
            'add_item' => [
                [
                    'appname' => 'menu',
                    'crud' => 'menu',
                    'name' => __('Ajouter un menu')
                ]
            ]
        ]
    ]
];