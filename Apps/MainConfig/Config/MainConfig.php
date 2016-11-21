<?php
return [
    'required' => true,
    'icon' => 'fa-cog',
    'default_ctrl' => 'MainConfig',
    'default_listing' => 'MainConfig',
    'name' => __('Configuration du site'),

    'appdesk' => [
        'MainConfig' => [
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