<?php
echo \Apps\Admin\Ctrl\Admin::view_static('Commun/Head', $params);
echo \Apps\Admin\Ctrl\Admin::view_static('Commun/Leftbar', ['apps' => $apps]);
?>
<div class="content">
    <?= \Apps\Admin\Ctrl\Admin::view_static('Commun/Header', $params) ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?= $tampon ?>
            </div>
        </div>
    </div>

</div>
<?php
echo \Apps\Admin\Ctrl\Admin::view_static('Commun/Foot', array_merge($params, ['enhancers' => $enhancers]));