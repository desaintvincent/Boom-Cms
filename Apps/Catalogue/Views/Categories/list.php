<h1>Liste des catégories</h1>
<?php foreach($categories as $category): ?>
    <h2><a href="<?= BASE_URL.URL_PAGE.DS.$category->slug ?>"><?= $category->title ?></a></h2>
<?php endforeach; ?>