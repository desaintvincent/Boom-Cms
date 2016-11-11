<?php
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
    'content' => array(
        'label' => 'Contenu',
        'type' => 'wysiwyg'
    ),
    'image' => array(
        'label' => 'Petite image qui fait plaiz',
        'type' => 'image'
    )
];