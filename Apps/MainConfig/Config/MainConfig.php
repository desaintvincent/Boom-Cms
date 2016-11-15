<?php
return [
    'required' => true,
    'icon' => 'fa-cog',
    'default_ctrl' => 'mainconfig',
    'default_listing' => 'mainconfig',
    'name' => __('Configuration du site'),
    'title' => 'title',

    'appdesk' => [
        'mainconfig' => [
            'name' => __('Configuration du site'),
            'type' => 'update',
            'icon' => 'fa-cog',
            'model' => 'MainConfig',
            'fields' => [
                'title' => __('Configuration du site')
            ],
        ]
    ]
];