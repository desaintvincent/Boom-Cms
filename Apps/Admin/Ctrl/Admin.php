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

    function setLayoutVars(&$ctrl = null)
    {
        if (empty($ctrl)) {
            $this->layoutVars['appdesk'] = App::getAllAppdesk();
            $this->layoutVars['enhancers'] = App::getAllEnhancers();
        } else {
            $ctrl->layoutVars['appdesk'] = App::getAllAppdesk();
            $ctrl->layoutVars['enhancers'] = App::getAllEnhancers();
        }


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
        if (isset($conf['appdesk'][$default_listing])) {
            $listing = $conf['appdesk'][$default_listing];
            $namespace = 'Apps\\' . ucfirst($appname) . '\Ctrl\\' . ucfirst($default_listing) . 'Admin';
            $ctrl = new $namespace(ucfirst($appname), $this->request, $this->response, $params, ucfirst($listing['model']));
            $this->setLayoutVars($ctrl);
            return $ctrl->action_listing($params);
        } else {
            return $this->view('Commun/Error', ['error' => __('Appdesk configuration not found')], true);
        }
    }

    function action_crud($params)
    {
        return $this->crudAndUpdate($params, "crud");
    }

    function action_update($params)
    {
        return $this->crudAndUpdate($params, "update");
    }

    protected function crudAndUpdate($params, $action = "crud")
    {
        $appname = 'Pages';
        if (!empty($params)) {
            $appname = $params[0];
        }

        $conf = App::getConfig($appname);
        $default_listing = $conf['default_listing'];
        if (isset($conf['appdesk'][$default_listing])) {
            $listing = $conf['appdesk'][$default_listing];
            $namespace = 'Apps\\' . ucfirst($appname) . '\Ctrl\\' . ucfirst($default_listing) . 'Admin';
            if (class_exists($namespace)) {
                $ctrl = new $namespace(ucfirst($appname), $this->request, $this->response, $params, ucfirst($listing['model']));
            } else {
                return $this->view('Commun/Error', ['error' => __('Class') . ' ' . $namespace . ' ' . __('doesn\'t exist')], true);
            }
            $this->setLayoutVars($ctrl);
            return $ctrl->crudAndUpdate($params, $action);
        } else {
            return $this->view('Commun/Error', ['error' => __('Appdesk configuration not found')], true);
        }
    }

    public function action_delete($params)
    {
        if (!empty($params) && !empty($params[0])) {
            $appname = $params[0];
            $crudName = $params[1];

            $conf = App::getConfig($appname);
            $default_listing = $conf['default_listing'];
            if (isset($conf['appdesk'][$default_listing])) {
                $listing = $conf['appdesk'][$default_listing];
                $namespace = 'Apps\\' . ucfirst($appname) . '\Ctrl\\' . ucfirst($default_listing) . 'Admin';
                $ctrl = new $namespace(ucfirst($appname), $this->request, $this->response, $params, ucfirst($listing['model']));
                $this->setLayoutVars($ctrl);
                return $ctrl->action_delete($params);
            } else {
                return $this->view('Commun/Error', ['error' => __('Appdesk configuration not found')], true);
            }

        } else {
            return;
        }

        echo 'Item supprimé';
    }
}