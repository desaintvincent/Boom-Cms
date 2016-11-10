<?php
return [
    'required' => true,
    'icon' => 'fa-users',
    'default_ctrl' => 'users',
    'default_listing' => 'users',
    'name' => __('Utilisateurs'),
    'title' => 'firstname',

    "appdesk" => [
        "users" => [
            'name' => __('Listing des utilisateurs'),
            'icon' => 'fa-user',
            'model' => 'Users',
            'fields' => [
                'firstname' => 'Prénom',
                'lastname' => 'Nom',
                'login' => 'Login',
            ],
            'add_item' => [
                [
                    'appname' => 'users',
                    'crud' => 'users',
                    'name' => __('Ajouter un utilisateur')
                ]
            ]
        ]
    ]
];