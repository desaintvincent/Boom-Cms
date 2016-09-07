<?php
namespace Apps\Admin\Ctrl;

use Boom\Ctrl\Controller;
use Boom\Helper\App;

class Admin extends Controller {

    function action_main($params) {
        $app_list = App::getApps();


        //$this->view('admin', ['aaaaa'=>'bbbbb']);
        var_dump($app_list);
    }
}