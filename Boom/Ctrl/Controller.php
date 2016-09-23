<?php
namespace Boom\Ctrl;

class Controller
{
    public $name;
    public $request;
    public $response;
    public $params;
    public $action;
    public $appname;
    public $layout;
    public $layoutVars = [];

    public function __construct($appname, $request, $response, $params = array(), $name)
    {
        $this->appname = ucfirst($appname);
        $this->request = $request;
        $this->response = $response;
        $this->params = $params;
        $this->name = $name;
        if (!isset($params[0]) || (isset($params[0]) && !empty($params[0]))) {
            $this->action = 'main';
        }

        $this->layout = "default";

        $this->loadModel();

        if (method_exists($this, 'setLayoutVars')) {
        	$this->setLayoutVars();
        }
    }

    public function run()
    {

    }

    public function action_main($params = null)
    {

    }

    public function view($view, $params = array(), $layout = false)
    {
        $path = 'Apps/' . $this->appname . '/Views/' . ucfirst($view) . '.php';
        extract($params);
        ob_start();
        require($path);
        $tampon = ob_get_contents();
        ob_end_clean();
        if($layout) {


            extract($this->layoutVars);
            $layout = 'Apps/' . $this->appname . '/Views/Layouts/' . $this->layout . '.php';
            include($layout);
        } else {
            echo $tampon;
        }
    }

    public static function view_static($view, $params = array(), $layout = false)///@todo gerer le fait qu'on puisse ne pas avoir de layouts
    {
        $path = 'Apps/' . substr(strrchr(get_called_class(), "\\"), 1) . '/Views/' . ucfirst($view) . '.php';
        extract($params);
        ob_start();
        require($path);
        $tampon = ob_get_contents();
        ob_end_clean();
        echo $tampon;
    }

    public function loadModel($name = null)
    {
        if (is_null($name)) {
            if (substr($this->name, -1) != "s") {
                $name = $this->name;
            } else {
                $name = ucfirst(substr($this->name, 0, -1));
            }
        }

        $namespace = 'Apps\\' . ucfirst($this->appname) . '\Model\\' . $name;
        if (class_exists($namespace) && !isset($this->{$name})) {
            $this->{$name} = new $namespace();
            $this->{$name}->appname = $this->appname;
        } else {
            echo 'Model ' . $namespace . ' not found </br>';
        }
    }
}