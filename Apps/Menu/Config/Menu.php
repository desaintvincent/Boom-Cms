<?php
return [
    'required' => true,
    'icon' => 'fa-bars',
    'default_ctrl' => 'menu',
    'default_listing' => 'menus',


    'name' => __('Menu'),
    'title' => 'title',

    'appdesk' => [
        'menus' => [
            'name' => __('Listing des menus'),
            'model' => 'Menus',
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