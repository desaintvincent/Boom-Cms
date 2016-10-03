<?php

?>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <?php if (isset($params['crud'])) : ?>
            <form class="form-signin" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <?= \Apps\Admin\Ctrl\Admin::view_static('crud', ['crud' => $params['crud']]); ?>
                <button class="btn btn-primary" type="submit">Enregistrer les informations</button>
            </form>
            <?php endif ?>
        </div>
    </div>
</div>