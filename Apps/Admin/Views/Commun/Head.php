<!DOCTYPE HTML>
<html>
<head>
    <title>Admin</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?=BASE_URL?>Apps/Admin/Static/dist/css/admin.css">
</head>
<body class="flat-blue">
<?php if (isset($error)) : ?>
    <div class="error"><?=$error?></div>
<?php endif ?>
