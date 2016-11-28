<?php
echo \Apps\Admin\Ctrl\Admin::view_static('Commun/Head', $params);
?>
<div class="content full signin">
    <?= \Apps\Admin\Ctrl\Admin::view_static('Commun/Header', $params) ?>
    <div class="container">

        <form class="form-signin" action="" method="post">
            <?php if (isset($error)) : ?>
                <div class="error">
                    <?= $error ?>
                </div>
            <?php endif ?>
            <h2 class="form-signin-heading"><?=__('Administration du site')?></h2>
            <label for="login" class="sr-only"><?= __('Identifiant') ?></label>
            <input type="text" id="login" name="login" class="form-control" placeholder="<?= __('Identifiant') ?>" required="" autofocus="">
            <label for="password" class="sr-only"><?= __('Mot de passe') ?></label>
            <input type="password" id="password" name="password" class="form-control" placeholder="<?= __('Mot de passe') ?>" required="">
            <?php
            /*
            ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <?php
            */
            ?>
            <button class="btn btn-lg btn-primary btn-block" type="submit"><?= __('Me connecter') ?></button>
        </form>
    </div>
    <?= \Apps\Admin\Ctrl\Admin::view_static('Commun/Foot', $params); ?>
</div>
