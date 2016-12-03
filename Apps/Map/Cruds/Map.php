<?php
return [
    'title' => array(
        'label' => 'Titre',
        'type' => 'text',
        'options' => array(
            'required' => true,
        ),
    ),
    'longitude' => array(
        'label' => 'Longitude',
        'type' => 'number',
        'options' => array(
            'required' => true,
        ),
    ),
    'latitude' => array(
        'label' => 'Latitude',
        'type' => 'number',
        'options' => array(
            'required' => true,
        ),
    ),
    'text' => array(
        'label' => 'Texte',
        'type' => 'wysiwyg',
    ),
];