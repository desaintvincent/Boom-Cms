<form class="form-horizontal" action=" " method="post"  id="contact_form">
    <fieldset>

        <!-- Form Name -->
        <legend><?= __('Nous contacter') ?></legend>

        <!-- Text input-->

        <div class="form-group">
            <label class="col-md-4 control-label"><?= __('Prénom') ?></label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input  name="first_name" placeholder="<?= __('Prénom') ?>" class="form-control"  type="text">
                </div>
            </div>
        </div>

        <!-- Text input-->

        <div class="form-group">
            <label class="col-md-4 control-label" ><?= __('Nom') ?></label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="last_name" placeholder="<?= __('Nom') ?>" class="form-control"  type="text">
                </div>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label"><?= __('E-mail') ?></label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input name="email" placeholder="<?= __('E-mail') ?>" class="form-control"  type="text">
                </div>
            </div>
        </div>

        <!-- Text area -->

        <div class="form-group">
            <label class="col-md-4 control-label"><?= __('Votre message') ?></label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <textarea class="form-control" name="comment" placeholder="<?= __('Votre message') ?>"></textarea>
                </div>
            </div>
        </div>

        <!-- Success message -->
        <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.</div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-4">
                <button type="submit" class="btn btn-warning" >Send <span class="glyphicon glyphicon-send"></span></button>
            </div>
        </div>

    </fieldset>
</form>