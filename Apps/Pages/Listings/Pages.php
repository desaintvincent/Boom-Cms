<?php

return [
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
];