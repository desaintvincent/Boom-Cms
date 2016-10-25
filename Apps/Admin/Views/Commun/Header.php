<nav class="header" data-spy="affix" data-offset-top="50">
    <div class="logo">
        <a href="<?= BASE_URL ?>admin">
            <img src="<?= BASE_URL ?>Apps/Admin/Static/img/Boom-logo-v1.svg" alt="Logo de Boom" width="100" height="27">
        </a>

    </div>
    <?php if(\Boom\Helper\Auth::connected()) : ?>
        <form class="form-signin" method="post">
            <a href="<?= BASE_URL ?>app/users/users/logout"
               class="btn btn-primary"><?= __('Déconnexion') ?></a>
        </form>
    <?php endif ?>
</nav>