<?= \Apps\Pages\Ctrl\Pages::view_static('Commun/Head', $params); ?>
<nav id="menu">
    <?= \Apps\Menus\Helper\Menu::display_main_menu(); ?>
</nav>
<div id="page">
    <?= \Apps\Pages\Ctrl\Pages::view_static('Commun/Header', array_merge($params, [
        'logo' => $logo,
        'img_header' => $img_header,
    ]));
    ?>
    <div class="container-content">
        <div class="content">
            <?= $tampon ?>
        </div>
    </div>

    <?= \Apps\Pages\Ctrl\Pages::view_static('Commun/Foot'); ?>

</div>