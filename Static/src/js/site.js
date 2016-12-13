function equalize_home_picture() {
    var height = 0;
    $('.homepage .img_container img').each(function () {
        if ($(this).height() > height) {
            height = $(this).height();
        }
    });

    $('.homepage .img_container img').height(height);
    //$('.homepage .img_container img').css('height', '100%');
}

$( document ).ready(function() {
    $(document).foundation();
    equalize_home_picture();
    $("#menu").mmenu({
        "offCanvas": {
            "position": "right"
        }
    });

    $('.main_menu.ajax a').on('click tap', function (e) {
        e.preventDefault();
        var $this = $(this);
        var href = $this.attr('href');
        if (href ==window.location.href.substr(this.href.lastIndexOf('/') + 1)) {
            return ;
        }

        $('.content').addClass('content-old');
        $.ajax({
            url: href + '?ajax'

        }).done(function( data ) {
            $('.header .main_menu li a').removeClass('active');
            $('.header .main_menu li a[href="'+href+'"]').addClass('active');
            $content = $('<div>').html(data);
            $content.addClass('content content-new');
            $content.find('img').on('load', equalize_home_picture);
            $('.container-content').append($content);
            if ( $( "#jsajax" ).length ) {
                eval(document.getElementById("jsajax").innerHTML);
                $('#jsajax').remove();
            }
            $(document).foundation();

            $(".content-new").animate({
                left: "0"
            }, 500, function() {
                $('.content-old').remove();
                $('.content-new').removeClass('content-new');
                var title = $('.hidentitle').text();
                window.history.pushState({"html":data, "pageTitle": title}, "", href);
                document.title = title;
                // Animation complete.
            });
        });
    });
});

