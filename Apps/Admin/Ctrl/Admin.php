<?php
namespace Apps\Admin\Ctrl;

use Boom\Ctrl\Controller;
use Boom\Helper\App;
use Boom\Helper\Data;

class Admin extends Controller
{
    function __construct($appname, $request, $response, array $params, $name)
    {
        parent::__construct($appname, $request, $response, $params, $name);
        if (isset($_SESSION['current_admin_url'])) {
            $_SESSION['previous_admin_url'] = $_SESSION['current_admin_url'];
        }
        $_SESSION['current_admin_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

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
        $default_listing = $conf['default_listing'];
        if (isset($conf['appdesk'][$default_listing])) {
            $listing = $conf['appdesk'][$default_listing];
            $model = '\Apps\\' . ucfirst($appname) . '\Model\\' . ucfirst($listing['model']);
            $model = new $model();
            $items = $model->find();
            $update_url = BASE_URL . "admin/update/" . $appname . "/" . $listing['model'] . "/";
            $see_url = BASE_URL . "admin/see/" . $appname . "/" . $listing['model'] . "/";
            $delete_url = BASE_URL . "admin/delete/" . $appname . "/" . $listing['model'] . "/";
            //$add_url = BASE_URL . "admin/crud/" . $appname;

            $params_view = [
                'appname' => $appname,
                'listing_title' => $listing['name'],
                'items' => $items,
                'fields' => $listing['fields'],
                'update_url' => $update_url,
                'see_url' => $see_url,
                'delete_url' => $delete_url,
                'add_items' => $listing['add_item']
            ];

            if ($appname == 'Pages') {
                $datas = Data::get('main');
                $params_view['home'] = $datas->home;
                $params_view['sethome_url'] = BASE_URL . "admin/sethome/";
            }
            $this->view('listing', $params_view, true);
        } else {
            error(__('Appdesk configuration not found'));
        }
    }

    function action_sethome($params) {
        if (isset($params[0]) && !empty($params[0])) {
            Data::set('main', ['home' => $params[0]]);
            return $this->response->withRedirect($_SESSION['previous_admin_url']);
        } else {
            error(__('il faut impérativement un id de page ici!'));
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

        $config_app = App::getConfig($appname);
        if (isset($params[1]) && !empty($params[1])) {
            $crudName = $params[1];
        } else {
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
            $this->view('crud', ['crud' => $crud, 'config' => $config_app], true);
        } else {
            error('"'.$crudName . '" \'s crud configuration of "'. $appname .'" application is not found');
        }
    }

    function update_menu($crud, $config_app, $item, $model = null) {
        $params_view = [
            'crud' => $crud,
            'config' => $config_app,
            'item' => $item
        ];

        if (isset($model)) {
            //si c'est une update
            $mitems = $model->get_mitems($item->id);
            $params_view['mitems'] = $mitems;
        }

        return $this->view('crud_menu', $params_view, true);
    }

    function action_update($params)
    {
        $appname = 'Pages';
        $crudName = 'Page';
        if (!empty($params) && !empty($params[0])) {
            $appname = $params[0];
            $crudName = $params[0];
        }

        $config_app = App::getConfig($appname);
        if (isset($params[1]) && !empty($params[1]) || is_int(intval($params[1]))) {
            $crudName = $params[1];
        } else {
            if (isset($config_app['default_crud'])) {
                $crudName = $config_app['default_crud'];
            }
        }

        if ((isset($params[1]) && is_int(intval($params[1]))) ||
            (isset($params[2]) && is_int(intval($params[2])))) {
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
            if ($appname == 'Menu') {
                return $this->update_menu($crud, $config_app, $item, isset($model) ? $model : null);
            } else {
                return $this->view('crud', ['crud' => $crud, 'config' => $config_app, 'item' => $item], true);
            }
        } else {
            error('"'.$crudName . '" \'s crud configuration of "'. $appname .'" application is not found');
        }
    }
}