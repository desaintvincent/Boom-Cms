<?php
$layout = \Boom\Helper\App::getConfig('Pages');
$layout = $layout['layouts'];
return [
    'title' => array(
        'label' => 'Titre',
        'type' => 'text',
        'options' => array(
            'required' => true,
        ),
    ),
    'slug' => array (
        'label' => 'Slug',
        'type' => 'slug',
        'options' => array(
            'linked' => 'title',
        ),
    ),
    'layout' => [
        'label' => 'Template',
        'type' => 'select',
        'value' => $layout,
    ],
    'content_gauche' => array(
        'label' => 'Contenu de gauche',
        'type' => 'wysiwyg'
    ),
    'image_gauche' => array(
        'label' => 'Image de gauche',
        'type' => 'image'
    ),
    'content_droit' => array(
    'label' => 'Contenu de droite',
    'type' => 'wysiwyg'
    ),
    'image_droit' => array(
    'label' => 'Image de droite',
    'type' => 'image'
    )
];