<?php
namespace Apps\Catalogue\Ctrl;

use Boom\Ctrl\Controller;

class Products extends Controller {
    function exist($name) {
        //c'est du statique c'est moche

    }

    function action_main($params) {
        echo 'action main : product = ' .$params[0];
    }
}