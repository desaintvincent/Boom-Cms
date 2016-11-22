<?php
echo \Apps\Pages\Ctrl\Pages::view_static('Commun/Head', $params);
echo \Apps\Pages\Ctrl\Pages::view_static('Commun/Header', $params);
?>
    <div class="content">

                <?= $tampon ?>
    </div>
<?php
echo \Apps\Pages\Ctrl\Pages::view_static('Commun/Foot');