<div class="homepage">

    <div class="hidentitle">
        <?= $page->title ?>
    </div>
    <h1><?= $page->title ?></h1>
    <div class="row">
        <?php if (!empty($page->image_gauche)) : ?>
        <div class="columns large-3">
            <img src="<?=$page->image_gauche?>">
        </div>
        <div class="columns large-6">
        <?php else : ?>
        <div class="columns large-9">
        <?php endif; ?>
            <?= $page->content_gauche ?>
        </div>

        <div class="columns large-3">
            <?php if (!empty($page->image_droit)) : ?>
            <img src="<?= $page->image_droit ?>">
            <?php else : ?>
                <?= $page->content_droit ?>
            <?php endif; ?>
        </div>
    </div>
</div>