<?php
namespace Apps\Admin\Ctrl;

use Boom\Ctrl\Controller;

class Admin extends Controller {

    function getApps()
    {
        $appList = array();
        if ($handle = opendir('Apps')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry[0] != '.' && $entry != 'Admin')
                    $appList[] = $entry;
            }
            closedir($handle);
        } else {
            die('impossible d\'ouvrir le dossier des applications');
        }
    }



    function action_main($params) {
        echo 'action main : Admin = ' .$params[0];


        $this->view('admin', ['aaaaa'=>'bbbbb']);





        //var_dump($app_list);
    }
}