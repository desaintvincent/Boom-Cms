<?php
$model = \Cake\ORM\TableRegistry::get('Menus');
$items = $model->find();
$menus = [];
foreach ($items as $item) {
    $menus[$item->id] = $item->title;
}
return [
    'title' => array(
        'label' => 'Nom du site',
        'type' => 'text',
        'options' => array(
            'required' => true,
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