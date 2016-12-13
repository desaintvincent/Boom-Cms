<?php
$layout = \Boom\Helper\App::getConfig('Pages');
$layout = $layout['layouts'];
$tab = [
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
    'description' => array (
        'label' => 'Description',
        'type' => 'textarea',
        'options' => array(
            'help' => 'Indique aux moteurs de recherche une phrase résumant le contenu de la page',
        ),
    ),
    'keywords' => array (
        'label' => 'Mot clés',
        'type' => 'text',
        'options' => array(
            'help' => 'Indique des mots clés supplémentaires aux moteurs de recherche, séparés par une virgule',
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
for ($i = 1; $i <= 20; $i++) {
    $tab['image_'.$i] = [
        'label' => 'Image mosaique ' . $i,
        'type' => 'image'
    ];
    $tab['legend_'.$i] = [
        'label' => 'Légende mosaique ' . $i,
        'type' => 'text',
    ];
}
return $tab;