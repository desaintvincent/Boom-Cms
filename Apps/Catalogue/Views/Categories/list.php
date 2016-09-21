<h1>Liste des catégories</h1>
<?php foreach($categories as $category): ?>git s
    <h2><a href="<?= URL_PAGE.DS.$category->cate_slug ?>"><?= $category->cate_title ?></a></h2>
<?php endforeach; ?>