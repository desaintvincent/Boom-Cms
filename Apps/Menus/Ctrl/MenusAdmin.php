<?php
namespace Apps\Menus\Ctrl;

use Apps\Pages\Model\Page;
use Boom\Ctrl\Controller;
use Boom\Ctrl\ControllerAdmin;
use Cake\ORM\TableRegistry;
use Boom\Helper\App;
use Boom\Helper\Data;


class MenusAdmin extends ControllerAdmin
{

    function update_menu($crud, $config_app, $item, $model = null)
    {
        $params_view = [
            'crud' => $crud,
            'config' => $config_app,
            'item' => $item
        ];

        if (isset($model)) {
            $params_view['mitems'] = $model->get_mitems($item->id);
        }
        return $this->view('crud_menu', $params_view, true);
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
                    $this->redirect("admin/update/$appname/" . ucfirst($crudName) . "/{$entity->id}");
                }
                return $this->view('crud', ['crud' => $crud, 'config' => $config_app], true);
            } else {
                return $this->update_menu($crud, $config_app, $item, isset($model) ? $model : null);
            }
        } else {
            d($crudFile);
            error('"' . $crudName . '" \'s crud configuration of "' . $appname . '" application is not found');
        }
    }
}