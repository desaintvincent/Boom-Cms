<?php
return [
    'title' => array(
        'label' => 'Titre',
        'type' => 'text',
        'options' => array(
            'required' => true,
        ),
    ),
    'apikey' => array(
        'label' => 'Clé API Google map',
        'type' => 'text',
        'option' => array(
            'help' => 'help'
        )
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
    'zoom_map' => array(
        'label' => 'Zoom de la Carte',
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