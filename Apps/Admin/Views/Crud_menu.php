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


                                        <li class="dd-item" data-id="2" data-name="Item 2" data-arg="item-arg-2" data-new="0" data-deleted="0">
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
                            <div id="menu-add form-inline">
                                <div class="sub-title">
                                <span class=''><?=__('Ajouter un nouveau item au menu')?>:</span>
                                <?= Apps\Menu\Helper\Menu::make_select_drivers() ?>
                                </div>
                                <div class="form-item" id="add-mitem">
                                    <?php
                                    /*
                                    ?>
                                    <div class="select-field">
                                        <div class='sub-title'><?=__('Page')?> :</div>
                                        <select class="form-control js-data-example-ajax required" data-url="<?=BASE_URL?>app/Menu/Menu/ajax/" id="addInputArg"></select>
                                    </div>
                                    <div class="text-field">
                                        <div class='sub-title'><?=__('Titre')?> :</div>
                                        <input type="text" class="form-control required" id="addInputTitle">
                                    </div>
                                    <button class="btn btn-info" id="addButton">Add</button>
                                    <?php
                                    */
                                    ?>
                                </div>

                                    <? /*<div class='sub-title'><?=__('Ajouter un nouveau item au menu')?></div>
                                <div class="form-group">
                                    <label for="addInputTitle">Title</label>
                                    <input type="text" class="form-control" id="addInputTitle" placeholder="Item title">
                                </div>
                                <div class="form-group">
                                    <label for="addInputArg">Argument</label>
                                    <input type="text" class="form-control" id="addInputArg" placeholder="item-arg">
                                </div>
                                <button class="btn btn-info" id="addButton">Add</button>*/ ?>
                            </div>

                            <div class="" id="menu-editor">
                                <?php
                                /*
                                ?>
                                <h3>Editing <span id="currentEditTitle"></span></h3>
                                <div class="form-group">
                                    <label for="addInputTitle">Title</label>
                                    <input type="text" class="form-control" id="editInputTitle" placeholder="Item title">
                                </div>
                                <div class="form-group">
                                    <label for="addInputArg">Argument</label>
                                    <input type="text" class="form-control" id="editInputArg" placeholder="item-arg">
                                </div>
                                <button class="btn btn-info" id="editButton">Edit</button>
                                <?php
                                */
                                ?>
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