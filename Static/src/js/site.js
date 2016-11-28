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

    $('.main_menu a').on('click tap', function (e) {
        e.preventDefault();
        var $this = $(this);
        var href = $this.attr('href');
        $.ajax({
            url: href + '?ajax'
        }).done(function( data ) {
            $content = $('<div>').html(data);
            $content.addClass('content content-new');
            $('.content').addClass('content-old');
            $content.find('img').on('load', equalize_home_picture);
            $('body').append($content);

            $(document).foundation();

            $(".content-new").animate({
                left: "0",
                right: "0"
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

