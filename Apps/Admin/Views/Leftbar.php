<div class="leftbar">
    <h2><?=__('Mes applications')?></h2>
    <?php if (!empty($apps['required'])) : ?>
        <h4>required</h4>
        <ul class="required">
            <?php foreach($apps['required'] as $app): ?>
                <li><a href="<?=BASE_URL?>admin/listing/<?= $app['name'] ?>"><?= $app['name'] ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>
    <?php if (!empty($apps['not_required'])) : ?>
        <h4>not_required</h4>
        <ul class="not_required">
            <?php foreach($apps['not_required'] as $app): ?>
                <li><a href="<?=BASE_URL?>admin/listing/<?= $app['name'] ?>"><?= $app['name'] ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>

</div>