$( document ).ready(function() {
    //alert( "ready!" );
    $("body").on('click', '.alert-box .close', function(event){
        event.preventDefault();
        $(this).parent().fadeOut(500);
    });

    $("body").on('submit', '.enhancer_form form', function(event){
        event.preventDefault();
        $form = $(this);
        $url = $form.attr('action');
        var error = false;
        var data = {
            name: $form.find("#name").val(),
            email: $form.find("#email").val(),
            message: $form.find("#message").val(),
        };
        console.log(data);
        if (data.name.length < 3) {
            $form.find('.description.name').fadeIn();
            error = true;
        } else {
            $form.find('.description.name').fadeOut();
        }
        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if (!testEmail.test(data.email)) {
            $form.find('.description.email').fadeIn();
            error =  true;
        } else {
            $form.find('.description.email').fadeOut();
        }

        if (data.message.length < 30) {
            $form.find('.description.message').fadeIn();
            error = true;
        } else {
            $form.find('.description.message').fadeOut();
        }

        if (error)
            return false;
        else {
            $form.find(' .actions').hide();
            $form.find(' .wait').show();
            $.ajax({
                type: "POST",
                url: $url,
                data: data,
                success: function(){
                    $form.find(' .wait').hide();
                    $form.find(' .success').show();
                    $form.find("#name").val('');
                    $form.find("#email").val('');
                    $form.find("#message").val('');
                },
                fail: function(){
                    $form.find(' .wait').hide();
                    $form.find(' .warning').show();
                }
            });
        }


        return false;
    });
});