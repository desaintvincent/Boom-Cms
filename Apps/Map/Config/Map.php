<?php
return [
    'required' => true,
    'icon' => 'fa-cog',
    'default_ctrl' => 'Map',
    'default_listing' => 'Map',
    'name' => __('Formulaire de contact'),

    'appdesk' => [
        'Map' => [
            'name' => __('Google Map'),
            'type' => 'update',
            'icon' => 'fa-map',
            'model' => 'Map',
            'fields' => [
                'title' => __('Google Map')
            ],
        ]
    ],
    'enhancers' => [
        'map' => [
            'appname' => 'Map',
            'name' => __('Google Map'),
            'controller' => 'Map',
            'action' => 'main'
        ]
    ],
];