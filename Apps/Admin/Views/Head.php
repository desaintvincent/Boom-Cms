<!DOCTYPE HTML>
<html>
<head>
    <title>Admin</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?=BASE_URL?>Apps/Admin/Static/dist/css/admin.css">
    <!--c'est la fête, on ajoute du css à la zeub-->
    <style>
        label {
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
            color: white;
        }
    </style>
</head>
<body>
<?php if (isset($error)) : ?>

    <div class="error"><?=$error?></div>
<?php endif ?>
