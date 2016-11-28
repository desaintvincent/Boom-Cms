<div class="enhancer_form">
    <form action="/app/FormContact/form" method="post" class="contact-form">
        <div class="input-container">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" />
        <span class="description name"><?=__('Votre nom doit comporter au minimum 3 caractères')?></span>
        </div>
        <div class="input-container">
        <label for="email">E-mail:</label>
        <input type="text" name="email" id="email" />
        <span class="description email"><?=__('Mauvait format d\'email .')?></span>
        </div>
            <div class="input-container">
        <label for="message">Message:</label>
        <textarea name="message" id="message" cols="30" rows="10"></textarea>
        <span class="description message"><?=__('Message trop court!')?></span>
            </div>

        <input type="submit" value="Send" class="button expand" />
        <div class="wait">
            <i class="fa fa-spinner fa-3x fa-spin" aria-hidden="true"></i>
        </div>
        <div data-alert class='alert-box success'><?= __('Votre message à bien été envoyé') ?><a href='#' class='close'>&times;</a></div>
        <div data-alert class='alert-box warning'><?= __('Une erreur est survenue: votre message n\'a pas été envoyé . Veuillez réessayer') ?></div>
    </form>
</div>