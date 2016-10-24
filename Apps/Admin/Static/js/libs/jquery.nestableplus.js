/*jslint browser: true, devel: true, white: true, eqeq: true, plusplus: true, sloppy: true, vars: true*/
/*global $ */

/*************** General ***************/

var updateOutput = function (e) {
    //console.log("output");
    var list = e.length ? e : $(e.target),
        output = list.data('output');
    if (window.JSON) {
        $('#json-output').val(window.JSON.stringify(list.nestable('serialize')));
    } else {
        alert('JSON browser support required for this page.');
    }
};

var nestableList = $("#nestable > .dd-list");

/***************************************/


/*************** Delete ***************/

var deleteFromMenuHelper = function (target) {
    if (target.data('new') == 1) {
        // if it's not yet saved in the database, just remove it from DOM
        target.fadeOut(function () {
            target.remove();
            updateOutput($('#nestable').data('output', $('#json-output')));
        });
    } else {
        // otherwise hide and mark it for deletion
        target.appendTo(nestableList); // if children, move to the top level
        target.data('deleted', '1');
        target.fadeOut();
    }
};

var deleteFromMenu = function (e) {
    e.preventDefault();
    var targetId = $(this).data('owner-id');
    var target = $('[data-id="' + targetId + '"]');

    var result = confirm("Delete " + target.data('title') + " and all its subitems ?");
    if (!result) {
        return;
    }

    // Remove children (if any)
    target.find("li").each(function () {
        deleteFromMenuHelper($(this));
    });

    // Remove parent
    deleteFromMenuHelper(target);

    // update JSON
    updateOutput($('#nestable').data('output', $('#json-output')));
};

/***************************************/


/*************** Edit ***************/


// Prepares and shows the Edit Form
var prepareEdit = function (e) {
    e.preventDefault();
    var targetId = $(this).data('owner-id');
    var target = $('[data-id="' + targetId + '"]');

    var type = target.data('type');
    $.ajax({
        url: '/app/Menu/Menus/view/' + type + '/edit'

    }).done(function(data) {
        $('#menu-editor').html(data);
        $('#editInputTitle').val(target.data('title'));
        $('#editInputArg').val(target.data('arg'));
        $("#editButton").attr("data-owner-id", target.data('id'));
        enable_menu_ajax();
    });



    /*editInputTitle.val(target.data("title"));
    editInputArg.val(target.data("arg"));
    currentEditTitle.html(target.data("title"));


    console.log("[INFO] Editing Menu Item " + editButton.data("owner-id"));

    menuEditor.fadeIn();
    */
};

// Edits the Menu item and hides the Edit Form
var editMenuItem = function ($this) {
    console.log('edit');
    console.log($this);
    var targetId = $this.data('owner-id');
    console.log(targetId);
    var target = $('[data-id="' + targetId + '"]');
    console.log(target);
    var newTitle = $('#editInputTitle').val();
    var newArg = $('#editInputArg').val();

    target.data("title", newTitle);
    target.data("arg", newArg);

    target.find("> .dd-handle").html(newTitle);

    //menuEditor.fadeOut();

    // update JSON
    updateOutput($('#nestable').data('output', $('#json-output')));
};

/***************************************/


/*************** Add ***************/

var newIdCount = 1;

var addToMenu = function () {
    var newTitle = $("#addInputTitle").val();
    var newArg = $("#addInputArg").val();
    var newType = $("#addInputType").val();
    var newId = newIdCount;

    nestableList.append(
        '<li class="dd-item" ' +
        'data-id="' + newId + '" ' +
        'data-title="' + newTitle + '" ' +
        'data-arg="' + newArg + '" ' +
        'data-type="' + newType + '" ' +
        'data-new="1" ' +
        'data-deleted="0">' +
        '<div class="dd-handle">' + newTitle + '</div> ' +
        '<span class="button-delete btn btn-default btn-xs pull-right" ' +
        'data-owner-id="' + newId + '"> ' +
        '<i class="fa fa-times-circle-o" aria-hidden="true"></i> ' +
        '</span>' +
        '<span class="button-edit btn btn-default btn-xs pull-right" ' +
        'data-owner-id="' + newId + '">' +
        '<i class="fa fa-pencil" aria-hidden="true"></i>' +
        '</span>' +
        '</li>'
    );

    newIdCount++;

    // update JSON
    updateOutput($('#nestable').data('output', $('#json-output')));

    // set events
    $("#nestable .button-delete").on("click", deleteFromMenu);
    $("#nestable .button-edit").on("click", prepareEdit);
};