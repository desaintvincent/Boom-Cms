<?php
return [
    'required' => true,
    'default_ctrl' => 'menus',
    'icon' => 'fa-bars',
    'default_listing' => 'menus',


    'name' => __('Menu'),
    'title' => 'title',

    'appdesk' => [
        'menus' => [
            'name' => __('Menus'),
            'icon' => 'fa-bars',
            'type' => 'listing',
            'model' => 'Menus',
            'fields' => [
                'title' => 'Titre du menu'
            ],
            'add_item' => [
                [
                    'appname' => 'menu',
                    'crud' => 'menus',
                    'name' => __('Ajouter un menu')
                ]
            ]
        ]
    ]
];