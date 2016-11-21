$('.main_menu a').on('click tap', function (e) {
    e.preventDefault();
    var $this = $(this);
    var href = $this.attr('href');
    $.ajax({
        url: href + '?ajax'
    }).done(function( data ) {
        data = '<div class="content content-new">' + data + '</div>';
        $('.content').addClass('content-old');
        $('body').append(data);
        $(".content-new").animate({
            left: "0",
            right: "0"
        }, 500, function() {
            $('.content-old').remove();
            $('.content-new').removeClass('content-new');

            // Animation complete.
        });
    });
});

