$('#button_notice').click(function() {
    var type = $('#select_notice').val();
    var text = $('#content_notice').val();
    $('.logs').append('<div class="new notice ' + type + '"><div class="text">' + text + '</div></div>')
})