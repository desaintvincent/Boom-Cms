<?php
echo \Apps\Pages\Ctrl\Pages::view_static('Commun/Head', $params);
echo \Apps\Pages\Ctrl\Pages::view_static('Commun/Header', $params);
?>
<h1>template de base front</h1>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <?= $tampon ?>
        </div>
    </div>
</div>
<?php
echo \Apps\Pages\Ctrl\Pages::view_static('Commun/Foot');