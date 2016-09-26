<!DOCTYPE HTML>
<html>
<head>
    <title>Admin</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?=BASE_URL?>Apps/Admin/Static/dist/css/admin.css">
</head>
<body class="leftbar_active">
<?php if (isset($error)) : ?>
    <div class="error"><?=$error?></div>
<?php endif ?>
