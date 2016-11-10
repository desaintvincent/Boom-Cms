<?php if ($edit) : ?>
<h3>Editing <span id="currentEditTitle"></span></h3>
<?php endif ?>
<div class="select-field">
    <div class='sub-title'><?=__('Page')?> :</div>
    <select class="form-control js-data-example-ajax required" data-type="<?=$driver['type']?>" data-url="<?=BASE_URL?>app/Menu/Menus/ajax/" id="<?= $edit ? 'editInputArg' : 'addInputArg' ?>"></select>
</div>
<div class="text-field">
    <div class='sub-title'><?=__('Titre')?> :</div>
    <input type="text" class="form-control required" id="<?= $edit ? 'editInputTitle' : 'addInputTitle' ?>">
</div>
<div class="actions-field">
    <button class="btn btn-success" id="<?= $edit ? 'editButton' : 'addButton' ?>"><?=$edit ? __('Editer') : __('Ajouter')?></button>
    <button class="btn btn-warning" id="cancelButton"><?=__('Annuler')?></button>
</div>
