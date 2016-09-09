<?php foreach($categories as $category): ?>
    <h2><a href="<?= $category->slug ?>"><?= $category->title ?></a></h2>
<?php endforeach; ?>