<?php
echo \Apps\Pages\Ctrl\Pages::view_static('Commun/Head', $params);
echo \Apps\Pages\Ctrl\Pages::view_static('Commun/Header', $params);
?>
<div class="content">
    <div class="row">
        <div class="columns large-12">
            <?= $tampon ?>
        </div>
    </div>
</div>
<?php
echo \Apps\Pages\Ctrl\Pages::view_static('Commun/Foot');