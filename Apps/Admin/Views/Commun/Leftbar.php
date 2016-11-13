<div class="leftbar reduced">

    <h2>
        <div class="toggle_applications">
        <span class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </span>
        </div>
        <span class="name"><?=__('Applications')?></span>
    </h2>
    <?php
    //dd($appdesk);
    ?>
    <?php if (!empty($appdesk['required'])) : ?>
        <ul class="required">
            <?php foreach($appdesk['required'] as $app): ?>
                <li>
                    <a href="<?=BASE_URL?>admin/<?= $app['type'] ?>/<?= $app['crud'] ?>">
                        <span class="icon"><i class="fa <?= $app['icon'] ?> fa-2x" aria-hidden="true"></i></span>
                        <span class="name"><?= $app['name'] ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>
    <?php if (!empty($appdesk['not_required'])) : ?>
        <ul class="not_required">
            <?php foreach($appdesk['not_required'] as $app): ?>
                <li>
                    <a href="<?=BASE_URL?>admin/<?= $app['type'] ?>/<?= $app['crud'] ?>">
                        <span class="icon"><i class="fa <?= $app['icon'] ?> fa-2x" aria-hidden="true"></i></span>
                        <span class="name"><?= $app['name'] ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>

</div>