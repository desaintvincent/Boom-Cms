<div class="col-xs-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <div class="title"><?=$params['config']['name']?> <?= isset($item) ? ': ' . $item->{$config['title']} : ''?></div>
            </div>
        </div>
        <div class="card-body">

            <form class="form-signin" enctype="multipart/form-data" action="#" method="post">
                <div class="text-field">
                    <div class='sub-title'><?=__('Titre')?></div>
                    <input type="text" class='form-control' value="<?= !empty($item) ? $item->title : '' ?>" name="menu_title" id="menu_title">
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
                                    <?php
                                    /*
                                     <!--- Initial Menu Items --->


                                        <li class="dd-item" data-id="2" data-name="Item 2" data-slug="item-slug-2" data-new="0" data-deleted="0">
                                            <div class="dd-handle">Item 2</div>
                                            <span class="btn btn-primary-delete btn btn-default btn-xs pull-right" data-owner-id="2">
                                                <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                                            </span>
                                            <span class="btn btn-primary-edit btn btn-default btn-xs pull-right" data-owner-id="2">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </span>
                                        </li>

                                        <!--------------------------->
                                     */
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div id="menu-add">
                                <div class='sub-title'><?=__('Ajouter un nouveau item au menu')?></div>
                                <select class="form-control select-basic" placeholder="<?=__('Selectionnez un type d\'item')?>">
                                    <option value="page">Page</option>
                                    <option value="link">Lien</option>
                                    <option value="text">Texte</option>
                                </select>

                                <select class="form-control js-data-example-ajax" data-url="<?=BASE_URL?>app/Menu/Menu/ajax/">
                                </select>
                                <? /*<div class='sub-title'><?=__('Ajouter un nouveau item au menu')?></div>
                                <div class="form-group">
                                    <label for="addInputName">Name</label>
                                    <input type="text" class="form-control" id="addInputName" placeholder="Item name">
                                </div>
                                <div class="form-group">
                                    <label for="addInputSlug">Slug</label>
                                    <input type="text" class="form-control" id="addInputSlug" placeholder="item-slug">
                                </div>
                                <button class="btn btn-info" id="addButton">Add</button>*/ ?>
                            </div>

                            <div class="" id="menu-editor" style="display: none;">
                                <h3>Editing <span id="currentEditName"></span></h3>
                                <div class="form-group">
                                    <label for="addInputName">Name</label>
                                    <input type="text" class="form-control" id="editInputName" placeholder="Item name">
                                </div>
                                <div class="form-group">
                                    <label for="addInputSlug">Slug</label>
                                    <input type="text" class="form-control" id="editInputSlug" placeholder="item-slug">
                                </div>
                                <button class="btn btn-info" id="editButton">Edit</button>
                            </div>
                        </div>
                    </div>

                    <div class="row output-container">
                        <div class="col-lg-12">
                            <h2 class="text-center">Output:</h2>
                            <textarea class="form-control" id="json-output" rows="5" name="output_items"></textarea>
                        </div>
                    </div>


                    <a href="http://stackoverflow.com/questions/32255773/jquery-nestable-output-into-mysql-database">GOOD HELP</a>

                <div class="save">
                    <button class="btn btn-primary" type="submit">Enregistrer les informations</button>
                </div>
            </form>
        </div>
    </div>
</div>