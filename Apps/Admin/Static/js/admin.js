$(document).ready(function () {
//confirmation popup
    $('.popup_confirm').click(function (e) {
        e.preventDefault();
        var what = $(this).data('what');
        var href = $(this).attr("href");
        swal({
            title: "Are you sure you want delete " + what,
            text: "You will not be able to recover this item!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FC5050",
            confirmButtonText: "Yes, delete it!",
            animation: "slide-from-top",
            closeOnConfirm: false
        }, function (isConfirm) {
            if (isConfirm) {
                //swal("Deleted!", "Your imaginary file has been deleted.", "success");
                window.location.href = href;
            }

        });
    });


//toogle leftbar
    $('.toggle_applications').click(function (e) {
        $('body').toggleClass('leftbar_active');
    });

    //selects
    $(".select-basic").select2({
        minimumResultsForSearch: Infinity,
    });
//menu
    $('#nestable').nestable({
        maxDepth: 5
    }).on('change', updateOutput);

    $(".select-basic").select2({
        minimumResultsForSearch: Infinity,
    });

    $(".js-data-example-ajax").select2({
        ajax: {
            url: function (params) {
                return '/app/Menu/Menu/ajax/' + params.term;
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
});