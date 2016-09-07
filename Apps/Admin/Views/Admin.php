<h1>Administration</h1>
<div class="sidebare">
    <?php foreach($params['apps'] as $app): ?>
        <a href="admin/crud/<?= $app['name'] ?>/<?= $app['crud'] ?>"><?= $app['name'] ?></a>
    <?php endforeach; ?>
</div>