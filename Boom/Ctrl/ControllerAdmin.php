<?php
namespace Boom\Ctrl;

use Boom\Ctrl\Controller;
use Boom\Helper\App;
use Boom\Helper\Data;
use Cake\ORM\TableRegistry;

class ControllerAdmin extends Controller {

    function action_listing($params = null)
    {
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
            return $this->view('Commun/Error', ['error' => __('Appdesk configuration not found')], true);
        }
    }

    function crudAndUpdate($params, $action = "crud")
    {
        if (!empty($params) && !empty($params[0])) {
            $appname = $params[0];
            $crudName = $params[0];
        }

        $config_app = App::getConfig($appname);
        if (isset($params[1]) && !empty($params[1]) && !is_int(intval($params[1]))) {
            $crudName = $params[1];
        } else {
            if (isset($config_app['default_crud'])) {
                $crudName = $config_app['default_crud'];
            }
        }
        if ($action == "update" && (
                (isset($params[1]) && is_int(intval($params[1]))) ||
                (isset($params[2]) && is_int(intval($params[2]))))
        ) {
            $item_id = is_int(intval($params[1])) && !empty(intval($params[1])) ? intval($params[1]) : intval($params[2]);
            if (!TableRegistry::exists(ucfirst($crudName))) {
                $namespace = 'Apps\\' . ucfirst($appname) . '\Model\\' . ucfirst(ucfirst($crudName)) . 'Table';
                $model = TableRegistry::get(ucfirst($crudName), ['className' => $namespace]);
            } else {
                $model = TableRegistry::get(ucfirst($crudName));
            }
            $item = $model->get($item_id);
            //dd($item);
            if ($this->request->isPost()) {
                $item = $model->patchEntity($item, $this->request->getParsedBody());
                $model->save($item);
            }
        } elseif ($action == "update") {
            error("No id passed to edit");
        }

        $crudFile = 'Apps' . DS . ucfirst($appname) . DS . 'Cruds' . DS . ucfirst($crudName) . '.php';
        if (file_exists($crudFile)) {
            $crud = require $crudFile;
            if ($action == "crud") {
                if ($this->request->isPost()) {
                    if (!TableRegistry::exists(ucfirst($crudName))) {
                        $namespace = 'Apps\\' . ucfirst($appname) . '\Model\\' . ucfirst($crudName) . 'Table';
                        $model = TableRegistry::get(ucfirst($crudName), ['className' => $namespace]);
                    } else {
                        $model = TableRegistry::get(ucfirst($crudName));
                    }
                    $entity = $model->newEntity($this->request->getParsedBody());
                    $model->save($entity);
                    return $this->redirect("admin/update/$appname/" . ucfirst($crudName) . "/{$entity->id}");
                }
                return $this->view('crud', ['crud' => $crud, 'config' => $config_app], true);
            } else {
                if ($appname == 'Menu') {
                    return $this->update_menu($crud, $config_app, $item, isset($model) ? $model : null);
                } else {
                    return $this->view('crud', ['crud' => $crud, 'config' => $config_app, 'item' => $item], true);
                }
            }
        } else {
            error('"' . $crudName . '" \'s crud configuration of "' . $appname . '" application is not found');

        }
    }

    public function view($view, $params = array(), $layout = false) // Inverser plutot non ? On aura plus souvent besoind du layout que non
    {
        $path = 'Apps/' . $this->appname . '/Views/' . ucfirst($view) . '.php';
        extract($params);
        ob_start();
        if (!file_exists($path)) {
            $path = 'Apps/Admin/Views/' . ucfirst($view) . '.php';
        }
        require($path);
        $tampon = ob_get_contents();
        ob_end_clean();
        if ($layout) {
            extract($this->layoutVars);
            if (!is_string($layout)) {
                $layout = 'Apps/Admin/Views/Layouts/' . $this->layout . '.php';
            }
            include($layout);
        } else {
            if (isset($_SERVER['enhancer']) && !empty($_SERVER['enhancer'])) {
                return $tampon;
            } else {

                return $this->response->write($tampon);
            }
        }
    }

    public function action_delete($params)
    {
        if (!empty($params) && !empty($params[0])) {
            $appname = $params[0];
            $crudName = $params[1];

            // TODO gerer autrement ces putain de params à la con !

            if (!TableRegistry::exists(ucfirst($crudName))) {
                $namespace = 'Apps\\' . ucfirst($appname) . '\Model\\' . ucfirst(ucfirst($crudName)) . 'Table';
                $model = TableRegistry::get(ucfirst($crudName), ['className' => $namespace]);
            } else {
                $model = TableRegistry::get(ucfirst($crudName));
            }

            $id = end($params);
            $item = $model->get($id);
            if ($item) {
                $model->delete($item);
            }
        } else {
            return;
        }

        echo 'Item supprimé';
    }
}