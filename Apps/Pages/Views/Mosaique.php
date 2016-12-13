<div class="mosaique">
    <div class="hidentitle">
        <?= $page->title ?>
    </div>
    <div class="row" data-equalizer="item">
        <div class="columns small-12">
            <h1><?= $page->title ?></h1>
        </div>
        <?php for ($i = 1; $i <= 20; $i++) :?>
            <?php if(!empty($page->{'image_'.$i})) : ?>
        <div class="columns large-3 medium-4 small-12 end">
            <div class="item">
                <div class="img_container" data-equalizer-watch="item">
                    <img src="<?= $page->{'image_'.$i} ?>">
                    <a class="zoom" href="<?= $page->{'image_'.$i} ?>" data-lightbox="<?= $page->{'image_'.$i} ?>"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                </div>
                <?php if(!empty($page->{'legend_'.$i})) : ?>
                <div class="legend">
                    <?=$page->{'legend_'.$i}?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        <?php endfor; ?>
    </div>
</div>