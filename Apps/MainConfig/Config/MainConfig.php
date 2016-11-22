<?php
return [
    'required' => true,
    'icon' => 'fa-cog',
    'default_ctrl' => 'MainConfig',
    'default_listing' => 'MainConfig',
    'name' => __('Configuration générale'),

    'appdesk' => [
        'MainConfig' => [
            'name' => __('Configuration générale'),
            'type' => 'update',
            'icon' => 'fa-cog',
            'model' => 'MainConfig',
            'fields' => [
                'title' => __('Configuration générale')
            ],
        ]
    ],
    'enhancers' => [
        'form_contact' => [
            'appname' => 'MainConfig',
            'name' => 'Formulaire de contact' ,
            'controller' => 'MainConfig',
            'action' => 'main'
        ]
    ],
];