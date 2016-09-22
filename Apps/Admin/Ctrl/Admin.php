<?php
namespace Apps\Admin\Ctrl;

use Boom\Ctrl\Controller;
use Boom\Helper\App;

class Admin extends Controller
{

    function setLayoutVars()
    {
        $this->layoutVars['apps'] = App::getAllApps();
        $this->layoutVars['enhancers'] = App::getAllEnhancers();
    }

    function action_main($params = null)
    {
        $this->view('content', [], true);
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
            $base_url = BASE_URL . "admin/update/" . $appname . "/" . $listingConfig['model'] . "/";
            //$add_url = BASE_URL . "admin/crud/" . $appname;

            $this->view('listing', [
                'listing_title' => $listingConfig['name'],
                'items' => $items,
                'fields' => $listingConfig['fields'],
                'base_url' => $base_url,
                'add_items' => $listingConfig['add_item']
            ], true);
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
            if ($this->request->isPost()) {
                $model = '\Apps\\' . ucfirst($appname) . '\Model\\' . ucfirst($crudName);
                $model = new $model($this->request->getParsedBody());
                $model->save();
            }
            $this->view('crud', ['crud' => $crud], true);
        } else {
            error('"'.$crudName . '" \'s crud configuration of "'. $appname .'" application is not found');
        }
    }

    function action_update($params)
    {
        $appname = 'Pages';
        $crudName = 'Page';
        if (!empty($params) && !empty($params[0])) {
            $appname = $params[0];
            $crudName = $params[0];
        }

        if (isset($params[1]) && !empty($params[1]) || is_int(intval($params[1]))) {
            $crudName = $params[1];
        } else {
            $config_app = App::getConfig($appname);
            if (isset($config_app['default_crud'])) {
                $crudName = $config_app['default_crud'];
            }
        }

        if (
            (isset($params[1]) && is_int(intval($params[1]))) ||
            (isset($params[2]) && is_int(intval($params[2])))
        ) {
            $item_id = is_int($params[1]) ? intval($params[1]) : intval($params[2]);

            $model = '\Apps\\' . ucfirst($appname) . '\Model\\' . ucfirst($crudName);
            $model = new $model();
            if ($this->request->isPost()) {
            	$model->update($item_id, $this->request->getParsedBody());
            }
            $item = $model->find($item_id);
        } else {
            error("No id passed to edit");
        }

        $crudFile = 'Apps' . DS . ucfirst($appname) . DS . 'Cruds' . DS . ucfirst($crudName) . '.php';
        if (file_exists($crudFile)) {
            $crud = require $crudFile;
            $this->view('update', ['crud' => $crud, 'item' => $item], true);
        } else {
            error('"'.$crudName . '" \'s crud configuration of "'. $appname .'" application is not found');
        }
    }
}