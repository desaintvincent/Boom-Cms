<div class="leftbar">
    <ul>
    <?php foreach($params['apps'] as $app): ?>
        <li><a href="<?=BASE_URL?>admin/listing/<?= $app['name'] ?>"><?= $app['name'] ?></a></li>
    <?php endforeach; ?>
    </ul>
</div>