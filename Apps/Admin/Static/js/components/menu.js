$(document).ready(function () {
    $("#addInputType").select2({
        minimumResultsForSearch: Infinity,
        placeholder: "Type",
        allowClear: true
    }).on("select2:select", function (e) {
        var selected_element = $(e.currentTarget);
        var select_val = selected_element.val();
        console.log(select_val);
        $.ajax({
            url: '/app/Menu/Menu/view/' + select_val,

        }).done(function( data ) {
            $('#add-mitem').html(data);
            enable_menu_ajax();
        });
    }).on("select2:unselecting", function (e) {
        clear_add_mitem();
    });

    enable_menu_ajax();

});

function clear_add_mitem() {
    $('#add-mitem').empty();
    $('#addInputType').select2("val", "");
    $('#addInputType').select2('val', 'All');
}

function enable_menu_ajax() {
    //le select
    $(".js-data-example-ajax").select2({
        ajax: {
            url: function (params) {
                return $(this).data('url') + params.term;
            },
            //dataType: 'json',
            dataType: "json",
            type: "GET",
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.title,
                            id: item.id
                        }
                    })
                };
            },
            data: function (params) {
                return ;
            }
        }
    });


    //l'ajout et anulation d'item

    editButton.on("click", editMenuItem);

    $("#nestable .button-delete").on("click", deleteFromMenu);

    $("#nestable .button-edit").on("click", prepareEdit);

    $("#menu-editor").on("click", function (e) {
        e.preventDefault();
    });

    $("#addButton").on("click", function (e) {
        e.preventDefault();
        addToMenu();
        clear_add_mitem();
    });

    $("#cancelButton").on("click", function (e) {
        e.preventDefault();
        clear_add_mitem();
    });

    //nestable
    $('#nestable').nestable({
        maxDepth: 5,
        group: 1
    }).on('change', updateOutput);

}