<div class="homepage">
    <div class="hidentitle">
        <?= $page->title ?>
    </div>
    <h1><?= $page->title ?></h1>
    <div class="row">
        <div class="columns large-6">
            <div class="main_container">
                <div class="ctr_container">
                <div class="img_container">
                    <img src="<?= $page->image_gauche ?>">
                    <div class="text">
                        <?= $page->content_gauche ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="columns large-6">
            <div class="main_container">
                <div class="ctr_container">
                    <div class="img_container">
                        <img src="<?= $page->image_droit ?>">

                        <div class="text">
                            <?= $page->content_droit ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>