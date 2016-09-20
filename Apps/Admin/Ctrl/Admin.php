<?php
namespace Apps\Admin\Ctrl;

use Boom\Ctrl\Controller;
use Boom\Helper\App;

class Admin extends Controller
{

    function setLayoutVars()
    {
        $this->layoutVars['apps'] = App::getApps();
    }

    function action_main($params = null)
    {
        $this->view('content');
    }

    function action_listing($params = null)
    {
        $appname = 'Pages';
        if (!empty($params)) {
        	$appname = $params[0];
        }

        $conf = App::getConfig($appname);
        $listing = $conf['default_listing'];

        $listingFile = 'Apps' . DS . ucfirst($appname) . DS . 'Listings' . DS . ucfirst($listing) . '.php';
        if (file_exists($listingFile)) {
            $listingConfig = require $listingFile;

            $model = '\Apps\\' . ucfirst($appname) . '\Model\\' . ucfirst($listingConfig['model']);
            $model = new $model();
            $items = $model->find();
            $base_url = "/admin/crud/" . $appname . "/" . $listingConfig['model'] . "/";

            $this->view('listing', [
                'items' => $items,
                'fields' => $listingConfig['fields'],
                'base_url' => $base_url
            ]);
        } else {
            error("Listing configuration not found");
        }
    }

    function action_crud($params)
    {
        $appname = 'Pages';
        $crudName = 'Page';
        if (!empty($params) && !empty($params[0])) {
            $appname = $params[0];
            $crudName = $params[0];
        }

        if (isset($params[1]) && !empty($params[1])) {
            $crudName = $params[1];
        } else {
            $config_app = App::getConfig($appname);
            if (isset($config_app['default_crud'])) {
                $crudName = $config_app['default_crud'];
            }
        }
        $crudFile = 'Apps' . DS . ucfirst($appname) . DS . 'Cruds' . DS . ucfirst($crudName) . '.php';
        if (file_exists($crudFile)) {
            $crud = require $crudFile;
            $this->view('crud', ['crud' => $crud]);
        } else {
            error('"'.$crudName . '" \'s crud configuration of "'. $appname .'" application is not found');
        }
    }
}