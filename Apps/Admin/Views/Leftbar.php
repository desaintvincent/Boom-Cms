<div class="leftbar">
    <ul>
    <?php foreach($params['apps'] as $app): ?>
        <li><a href="<?=BASE_URL?>admin/crud/<?= $app['name'] ?>/<?= $app['crud'] ?>"><?= $app['name'] ?></a></li>
    <?php endforeach; ?>
    </ul>
</div>