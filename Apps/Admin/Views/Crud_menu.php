<h1><?=__('Création du menu')?></h1>
<form class="form-signin" enctype="multipart/form-data" action="#" method="post">
    <div class="text-field">
        <label for="title">Titre</label>
        <input type="text" value="<?= !empty($item) ? $item->title : '' ?>" name="menu_title" id="menu_title">
    </div>
    <div class="menu-field">


        <div class="row">
            <div class="columns large-6 medium-6">
                <h3>Menu</h3>
                <div class="dd nestable" id="nestable">
                    <ol class="dd-list">

                        <!--- Initial Menu Items --->

                        <li class="dd-item" data-id="2" data-name="Item 2" data-slug="item-slug-2" data-new="0" data-deleted="0">
                            <div class="dd-handle">Item 2</div>
                            <span class="button-delete btn btn-default btn-xs pull-right"
                                  data-owner-id="2">
                  <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                </span>
                            <span class="button-edit btn btn-default btn-xs pull-right"
                                  data-owner-id="2">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </span>
                        </li>

                        <!--------------------------->

                    </ol>
                </div>
            </div>
            <div class="columns large-6 medium-6">
                <div class="form-inline" id="menu-add">
                    <h3>Add new menu item</h3>
                    <div class="form-group">
                        <label for="addInputName">Name</label>
                        <input type="text" class="form-control" id="addInputName" placeholder="Item name">
                    </div>
                    <div class="form-group">
                        <label for="addInputSlug">Slug</label>
                        <input type="text" class="form-control" id="addInputSlug" placeholder="item-slug">
                    </div>
                    <button class="btn btn-info" id="addButton">Add</button>
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
            <div class="columns large-12">
                <h2 class="text-center">Output:</h2>
                <textarea class="form-control" id="json-output" rows="5" name="output_items"></textarea>
            </div>
        </div>


        <a href="http://stackoverflow.com/questions/32255773/jquery-nestable-output-into-mysql-database">GOOD HELP</a>
    </div>
    <div class="save">
        <button class="button" type="submit">Enregistrer les informations</button>
    </div>
</form>