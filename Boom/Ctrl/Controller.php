<?php
namespace Boom\Ctrl;

class Controller
{
    protected $request;
    protected $response;
    protected $params;
    protected $action;
    protected $appname;

    public function __construct($appname, $request, $response, $params = array())
    {
        $this->appname = ucfirst($appname);
        $this->request = $request;
        $this->response = $response;
        $this->params = $params;
        if (!empty($params[0])) {
            $this->action = 'main';
        }
    }

    public function run()
    {

    }

    public function action_main()
    {

    }

    public function view($view, $params = array())
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
}