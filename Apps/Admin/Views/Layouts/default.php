<?php
echo \Apps\Admin\Ctrl\Admin::view_static('head', $params);
echo \Apps\Admin\Ctrl\Admin::view_static('header', $params);
echo \Apps\Admin\Ctrl\Admin::view_static('leftbar', ['apps' => $apps]);
?>
<div class="content">
    <div class="row">
        <div class="columns large-12">
            <?= $tampon ?>
        </div>
    </div>
</div>
<?php
echo \Apps\Admin\Ctrl\Admin::view_static('foot', $params);