<div class="leftbar">
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
    <?php if (!empty($apps['required'])) : ?>
        <ul class="required">
            <?php foreach($apps['required'] as $app): ?>
                <li>
                    <a href="<?=BASE_URL?>admin/listing/<?= $app['name'] ?>">
                        <span class="icon"><i class="fa <?= $app['icon'] ?> fa-2x" aria-hidden="true"></i></span>
                        <span class="name"><?= $app['name'] ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>
    <?php if (!empty($apps['not_required'])) : ?>
        <ul class="not_required">
            <?php foreach($apps['not_required'] as $app): ?>
                <li>
                    <a href="<?=BASE_URL?>admin/listing/<?= $app['name'] ?>">
                        <span class="icon"><i class="fa <?= $app['icon'] ?> fa-2x" aria-hidden="true"></i></span>
                        <span class="name"><?= $app['name'] ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>
</div>