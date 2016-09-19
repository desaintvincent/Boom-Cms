<h1>Liste des catégories</h1>
<?php foreach($categories as $category): ?>
    <h2><a href="<?= $category->cate_slug ?>"><?= $category->cate_title ?></a></h2>
<?php endforeach; ?>