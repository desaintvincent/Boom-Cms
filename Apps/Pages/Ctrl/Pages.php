<?php
namespace Apps\Pages\Ctrl;

use Boom\Ctrl\Controller;

class Pages extends Controller {
    function exist($name) {
        //c'est du statique c'est moche

    }

    function action_main($params = NULL) {
        echo 'action main : page = ';
        d($params);
    }
}