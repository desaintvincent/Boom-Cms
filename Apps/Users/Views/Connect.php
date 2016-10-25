<?php
echo \Apps\Admin\Ctrl\Admin::view_static('Commun/Head', $params);
?>
<div class="content full">
    <?= \Apps\Admin\Ctrl\Admin::view_static('Commun/Header', $params) ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="" method="post">
                    <label for="login"><?= __('Login') ?></label>
                    <input type="text" name="login" id="login">
                    <label for="password"><?= __('Mot de passe') ?></label>
                    <input type="password" name="password" id="password">
                    <input type="submit" value="<?= __('Me connecter') ?>">
                </form>
            </div>
        </div>
    </div>
    <?= \Apps\Admin\Ctrl\Admin::view_static('Commun/Foot', $params); ?>
</div>
