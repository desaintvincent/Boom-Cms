<?php
echo \Apps\Admin\Ctrl\Admin::view_static('Commun/Head', $params);
echo \Apps\Admin\Ctrl\Admin::view_static('Commun/Header', $params);
echo \Apps\Admin\Ctrl\Admin::view_static('Commun/Leftbar', ['apps' => $apps]);
?>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <?= $tampon ?>
        </div>
    </div>
</div>
<?php
echo \Apps\Admin\Ctrl\Admin::view_static('Commun/Foot', array_merge($params, ['enhancers' => $enhancers]));