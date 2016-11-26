<?php
echo \Apps\Pages\Ctrl\Pages::view_static('Commun/Head', $params);
echo \Apps\Pages\Ctrl\Pages::view_static('Commun/Header', array_merge($params, [
    'logo' => $logo,
    'img_header' => $img_header,
]));
?>
<h1>template de base front</h1>
<div class="content">
    <?= $tampon ?>
</div>
<?php
echo \Apps\Pages\Ctrl\Pages::view_static('Commun/Foot');