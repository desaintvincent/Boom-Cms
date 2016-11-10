<div class="col-xs-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <div class="title"><?=$params['config']['name']?> <?= isset($item) ? ': ' . $item->{$config['title']} : ''?></div>
            </div>
        </div>
        <div class="card-body">

            <form class="form" enctype="multipart/form-data" action="#" method="post">
                <div class="text-field">
                    <div class='sub-title'><?=__('Titre')?></div>
                    <input type="text" class='form-control' value="<?= !empty($item) ? $item->title : '' ?>" name="title" id="menu_title">
                </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="menu-field">
                                <div class='sub-title'><?=__('Menu')?></div>
                                <div class="dd nestable" id="nestable">
                                    <?php if(isset($mitems)) : ?>
                                        <?php
                                        \Apps\Menu\Helper\Menu::make_admin_menu($mitems);
                                        ?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div id="menu-add form-inline">
                                <div class="sub-title">
                                <span class=''><?=__('Ajouter un nouveau item au menu')?>:</span>
                                <?= Apps\Menu\Helper\Menu::make_select_drivers() ?>
                                </div>
                                <div class="form-item" id="add-mitem">
                                </div>
                            </div>

                            <div class="" id="menu-editor">
                            </div>
                        </div>
                    </div>
                    <textarea class="form-control hidden" id="json-output" rows="5" name="mitems"></textarea>

                <div class="save">
                    <button class="btn btn-primary" type="submit">Enregistrer les informations</button>
                </div>
            </form>
        </div>
    </div>
</div>