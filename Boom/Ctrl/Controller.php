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

    public function __construct($appname, $request, $response, $params = array(), $name)
    {
        $this->appname = ucfirst($appname);
        $this->request = $request;
        $this->response = $response;
        $this->params = $params;
        $this->name = $name;
        if (!empty($params[0])) {
            $this->action = 'main';
        }

        $this->loadModel();
    }

    public function run()
    {

    }

    public function action_main()
    {

    }

    public function view($view, $params = array(), $name)
    {
        $path = 'Apps/' . $this->appname . '/Views/' . ucfirst($view) . '.php';
        ob_start();
        require($path);
        $tampon = ob_get_contents();
        ob_end_clean();
        echo $tampon;
    }

    public static function view_static($view, $params = array())
    {
        $path = 'Apps/' . substr(strrchr(get_called_class(), "\\"), 1) . '/Views/' . ucfirst($view) . '.php';
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
        if (class_exists($namespace) && !isset($this->$name)) {
            $this->$name = new $namespace();
        } else {
            echo 'Model ' . $name . 'not found';
        }
    }
}