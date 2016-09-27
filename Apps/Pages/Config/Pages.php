<?php
return [
    'required' => true,
    'icon' => 'fa-file-text-o',
    'default_ctrl' => 'pages',
    'default_listing' => 'pages',


    'name' => __('Page'),
    'title' => 'title',


    'appdesk' => [
        'pages' => [
            'name' => __('Listing des pages'),
            'model' => 'Page',
            'fields' => [
                'title' => 'Titre de la page'
            ],
            'add_item' => [
                [
                    'appname' => 'pages',
                    'crud' => 'page',
                    'name' => __('Ajouter une page')
                ]
            ]
        ]
    ]
];