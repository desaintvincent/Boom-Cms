<?php
$model_menu = \Cake\ORM\TableRegistry::get('Menus');
$items_menus = $model_menu->find();
$menus = [];
foreach ($items_menus as $item_menu) {
    $menus[$item_menu->id] = $item_menu->title;
}
return [
    'title' => array(
        'label' => 'Nom du site',
        'type' => 'text',
        'options' => array(
            'required' => true,
        ),
    ),
    'apikey' => array(
        'label' => __('Clé API google analytics'),
        'type' => 'text',
        'options' => array(
            'help' => 'wip',
        ),
    ),
    'logo' => array(
        'label' => 'Logo du site',
        'type' => 'image'
    ),
    'menu' => [
        'label' => 'Menu',
        'type' => 'select',
        'value' => $menus
    ],
    'image_header' => array(
        'label' => 'Image du header',
        'type' => 'image'
    )
];