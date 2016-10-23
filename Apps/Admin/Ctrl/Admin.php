<?php
namespace Apps\Admin\Ctrl;

use Boom\Ctrl\Controller;
use Boom\Helper\App;
use Boom\Helper\Data;
use Cake\ORM\TableRegistry;

class Admin extends Controller
{
    public $hasModel = false;

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
        return $this->view('content', [], true);
    }

    function action_listing($params = null)
    {
        $appname = 'Pages';
        if (!empty($params)) {
            $appname = $params[0];
        }

        $conf = App::getConfig($appname);
        $default_listing = $conf['default_listing'];

        if (isset($params[1])) {
            $default_listing = strtolower($params[1]);
        }

        if (isset($conf['appdesk'][$default_listing])) {
            $listing = $conf['appdesk'][$default_listing];
            if (!TableRegistry::exists($listing['model'])) {
                $namespace = 'Apps\\' . ucfirst($appname) . '\Model\\' . ucfirst($listing['model']) . 'Table';
                $model = TableRegistry::get($listing['model'], ['className' => $namespace]);
            } else {
                $model = TableRegistry::get($listing['model']);
            }
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
                $params_view['sethome_url'] = BASE_URL . "app/pages/pages/sethome/";
            }
            return $this->view('listing', $params_view, true);
        } else {
            error(__('Appdesk configuration not found'));
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
                if (!TableRegistry::exists(ucfirst($crudName))) {
                    $namespace = 'Apps\\' . ucfirst($appname) . '\Model\\' . ucfirst($crudName) . 'Table';
                    $model = TableRegistry::get(ucfirst($crudName), ['className' => $namespace]);
                } else {
                    $model = TableRegistry::get(ucfirst($crudName));
                }
                $entity = $model->newEntity($this->request->getParsedBody());
                $model->save($entity);
                $this->redirect("admin/update/$appname/" . ucfirst($crudName) . "/{$entity->id}");
            }
            return $this->view('crud', ['crud' => $crud, 'config' => $config_app], true);
        } else {
            error('"' . $crudName . '" \'s crud configuration of "' . $appname . '" application is not found');
        }
    }

    function update_menu($crud, $config_app, $item, $model = null)
    {
        $params_view = [
            'crud' => $crud,
            'config' => $config_app,
            'item' => $item
        ];

        if (isset($model)) {
            //si c'est une update;
            $params_view['mitems'] = $model->get_mitems($item->id);
        }

        return $this->view('crud_menu', $params_view, true);
    }

    function action_update($params)
    {
        $appname = 'Pages';
        $crudName = 'Pages';
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
            (isset($params[2]) && is_int(intval($params[2])))
        ) {
            $item_id = is_int($params[1]) ? intval($params[1]) : intval($params[2]);
            if (!TableRegistry::exists(ucfirst($crudName))) {
                $namespace = 'Apps\\' . ucfirst($appname) . '\Model\\' . ucfirst(ucfirst($crudName)) . 'Table';
                $model = TableRegistry::get(ucfirst($crudName), ['className' => $namespace]);
            } else {
                $model = TableRegistry::get(ucfirst($crudName));
            }
            $item = $model->get($item_id);
            if ($this->request->isPost()) {
                $item = $model->patchEntity($item, $this->request->getParsedBody());
                $model->save($item);
            }
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
            error('"' . $crudName . '" \'s crud configuration of "' . $appname . '" application is not found');
        }
    }

    public function action_delete($params)
    {
        // @TODO
    }
}