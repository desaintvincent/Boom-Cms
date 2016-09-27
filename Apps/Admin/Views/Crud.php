<h1><?=$params['config']['name']?> <?= isset($item) ? ': ' . $item->{$config['title']} : ''?></h1>
<?= \Boom\Helper\Crud::make_form($crud, isset($item) ? $item : null) ?>