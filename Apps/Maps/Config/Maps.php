<?php
return [
    'required' => true,
    'icon' => 'fa-cog',
    'default_ctrl' => 'Maps',
    'default_listing' => 'Maps',
    'name' => __('Configuration de la carte'),

    'appdesk' => [
        'Maps' => [
            'name' => __('Google Map'),
            'type' => 'update',
            'icon' => 'fa-map',
            'model' => 'Maps',
            'fields' => [
                'title' => __('Google Map')
            ],
        ]
    ],
    'enhancers' => [
        'maps' => [
            'appname' => 'Maps',
            'name' => __('Google Map'),
            'controller' => 'Maps',
            'action' => 'main'
        ]
    ],
];