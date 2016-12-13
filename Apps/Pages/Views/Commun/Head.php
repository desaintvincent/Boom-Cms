<!DOCTYPE HTML>
<html>
<head>
    <title><?=$page->title?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php if (isset($page->keywords) && !empty($page->keywords)) : ?>
    <meta name="keywords" content="<?= $page->keywords ?>"/>
    <?php endif ?>
    <?php if (isset($page->description) && !empty($page->description)) : ?>
    <meta name="description" content="<?= $page->description ?>"/>
    <?php endif ?>

    <link rel="stylesheet" href="<?=BASE_URL?>Static/dist/css/site.css">
</head>
<body>
<?php if (isset($error)) : ?>
    <div class="error"><?=$error?></div>
<?php endif ?>
