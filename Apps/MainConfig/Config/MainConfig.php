<?php
return [
    'required' => true,
    'icon' => 'fa-cog',
    'default_ctrl' => 'mainconfig',
    'default_listing' => 'mainconfig',
    'name' => __('Configuration du site'),


    'appdesk' => [
        'mainconfig' => [
            'name' => __('Configuration du site'),
            'type' => 'crud',
            'icon' => 'fa-cog',
            'model' => 'MainConfig',
            'fields' => [
                'title' => __('Configuration du site')
            ],
        ]
    ]
];