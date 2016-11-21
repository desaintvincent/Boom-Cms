<div class="card">
    <div class="card-header">
        <div class="card-title">
            <div class="title"><?= __('Error') ?></div>
        </div>
    </div>

    <div class="warning" style="border: 1px solid red; padding: 10px; color: red">
        <?= $error ?>
    </div>
    <div class="backtrace-block">
        <div class="title">backtrace:</div>
        <div class="backtrace">
            <?= generateCallTrace() ?>
        </div>
    </div>
</div>