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
            error(__('Appdesk configuration not found'));
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
}