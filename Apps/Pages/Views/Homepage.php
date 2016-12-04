<div class="homepage">
    <div class="hidentitle">
        <?= $page->title ?>
    </div>
    <div class="row">
        <div class="columns small-12">
            <h1><?= $page->title ?></h1>
        </div>
        <div class="columns large-6 medium-6">
            <div class="main_container">
                <div class="ctr_container">
                <div class="img_container">
                    <img src="<?= $page->image_gauche ?>">
                    <div class="text">
                        <?= $page->content_gauche ?>
                    </div>
                    <a class="zoom" href="<?= $page->image_gauche ?>" data-lightbox="<?= $page->image_gauche ?>"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        </div>
        <div class="columns large-6 medium-6">
            <div class="main_container">
                <div class="ctr_container">
                    <div class="img_container">
                        <img src="<?= $page->image_droit ?>">

                        <div class="text">
                            <?= $page->content_droit ?>
                        </div>
                        <a class="zoom" href="<?= $page->image_droit ?>" data-lightbox="<?= $page->image_droit ?>"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>