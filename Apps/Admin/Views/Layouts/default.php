<?php
echo \Apps\Admin\Ctrl\Admin::view_static('Commun/Head', $params);
echo \Apps\Admin\Ctrl\Admin::view_static('Commun/Leftbar', ['appdesk' => $appdesk]);
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
    <?= \Apps\Admin\Ctrl\Admin::view_static('Commun/Foot', array_merge($params, ['enhancers' => $enhancers])); ?>
</div>