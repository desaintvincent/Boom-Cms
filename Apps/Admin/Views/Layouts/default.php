<?php
/*
echo
echo \Apps\Admin\Ctrl\Admin::view_static('Commun/Header', $params);
echo \Apps\Admin\Ctrl\Admin::view_static('Commun/Leftbar', ['apps' => $apps]);
?>
<div class="content">
    <div class="row">
<<<<<<< HEAD
        <div class="columns large-12">

=======
        <div class="col-lg-12">
            <?= $tampon ?>
>>>>>>> bb394080650d4711a3579883ed518ac469e4224d
        </div>
    </div>
</div>
<?php
echo \Apps\Admin\Ctrl\Admin::view_static('Commun/Foot', array_merge($params, ['enhancers' => $enhancers]));
*/
?>

<?= \Apps\Admin\Ctrl\Admin::view_static('Commun/Head', $params); ?>
<div class="app-container">
    <div class="row content-container">
        <?= \Apps\Admin\Ctrl\Admin::view_static('Commun/Header', $params) ?>
        <?= \Apps\Admin\Ctrl\Admin::view_static('Commun/Leftbar', ['apps' => $apps]) ?>
        <!-- Main Content -->
        <div class="container-fluid">
            <div class="side-body padding-top">
                <?= $tampon ?>
            </div>
        </div>
    </div>
</div>
<?= \Apps\Admin\Ctrl\Admin::view_static('Commun/Foot', array_merge($params, ['enhancers' => $enhancers])); ?>
