<?php
namespace Apps\Menu\Ctrl;
use Boom\Ctrl\Controller;
use Boom\Helper\App;
use Boom\Helper\Data;
class Menu extends Controller {
    function __construct($appname, $request, $response, array $params, $name)
    {
        parent::__construct($appname, $request, $response, $params, $name);
        if (isset($_SESSION['current_url'])) {
            $_SESSION['previous_url'] = $_SESSION['current_url'];
        }
        $_SESSION['current_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
    function action_main($params = NULL) {
        ///@todo faire en sorte de pouvoir selectionner la menu d'accueil. actuellement c'est en dure
        //1st param is for menu of course
        if (empty($params[0])) {
            //on cherche la menu d'accueil
            $id = Data::get('main');
            $menu = $this->Menu->find(intval($id->home));
            define('URL_MENU', $menu->slug);
        } else {
            $menu = $this->Menu->find('first', ['where' => ['slug' => $params[0]]]);
            if (empty($menu)) {
                //on gere la 404
                return $this->response;
            }

            //si on trouve la menu, on retire le nom de la menu des params
            define('URL_MENU', $params[0]);
            array_shift($params);
        }

        $pattern = '/<enhancer .*">.*<\/enhancer>/';
        $menu->content = preg_replace_callback($pattern, function ($matches) use ($params){
            //parsing enhancer
            $params_enhancer = '{'.GetBetween("data-params=\"{", "}\"", $matches[0]).'}';
            $params_enhancer = str_replace("&quot;", "\"", $params_enhancer);
            $params_enhancer = str_replace("&#039;", "'", $params_enhancer);
            $params_enhancer = json_decode($params_enhancer);
            $appname = ucfirst($params_enhancer->appname);
            $ctrl = ucfirst($params_enhancer->controller);
            $action = $params_enhancer->action;
            //creation des nouveaux params
            array_unshift($params, $ctrl, $action);
            //on dispatch dans un tampon
            ob_start();
            $boom = new \Boom\Bootstrap($this->request, $this->response);
            $boom->dispatch($appname, $params);
            $tampon = ob_get_contents();
            ob_end_clean();
            return $tampon;
        }, htmlspecialchars_decode($menu->content));
        return $this->view('menu', ['menu' => $menu], true);
    }
}