<?php
return [
    'required' => true,
    'default_ctrl' => 'Menus',
    'icon' => 'fa-bars',
    'default_listing' => 'Menus',
    'default_crud' => 'Menus',


    'name' => __('Menu'),
    'title' => 'title',

    'appdesk' => [
        'Menus' => [
            'name' => __('Menus'),
            'icon' => 'fa-bars',
            'type' => 'listing',
            'model' => 'Menus',
            'fields' => [
                'title' => 'Titre du menu'
            ],
            'add_item' => [
                [
                    'appname' => 'Menus',
                    'crud' => 'Menus',
                    'name' => __('Ajouter un menu')
                ]
            ]
        ]
    ]
];