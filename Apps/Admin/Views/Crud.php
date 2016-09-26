<h1><?=$params['config']['name']?> <?= isset($item) ? ': ' . $item->{$params['config']['title']} : ''?></h1>
<?= \Boom\Helper\Crud::make_form($params['crud']) ?>