<?php
namespace Apps\Pages\Ctrl;

use Boom\Ctrl\Controller;
use Boom\Helper\Data;

class Pages extends Controller
{
    function __construct($appname, $request, $response, array $params, $name)
    {
        parent::__construct($appname, $request, $response, $params, $name);
        if (isset($_SESSION['current_url'])) {
            $_SESSION['previous_url'] = $_SESSION['current_url'];
        }
        $_SESSION['current_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    function action_sethome($params)
    {
        if (isset($params[0]) && !empty($params[0])) {
            Data::set('main', ['home' => $params[0]]);
            return $this->redirect("admin/listing/Pages");
        } else {
            error(__('il faut impérativement un id de page ici!'));
        }
    }

    function action_main($params = NULL)
    {
        //1st param is for page of course
        if (empty($params[0])) {
            //on cherche la page d'accueil
            $id = Data::get('main');
            $page = $this->Pages->get(intval($id->home));
            define('URL_PAGE', $page->slug);
        } else {
            $page = $this->Pages->find()->where(['slug' => $params[0]])->first();
            if (empty($page)) {
                //on gere la 404
                return $this->response->withStatus(404);
            }

            //si on trouve la page, on retire le nom de la page des params
            define('URL_PAGE', $params[0]);
            array_shift($params);
        }

        $pattern = '/<enhancer .*">.*<\/enhancer>/';
        $page->content = preg_replace_callback($pattern, function ($matches) use ($params) {
            //parsing enhancer
            $params_enhancer = '{' . GetBetween("data-params=\"{", "}\"", $matches[0]) . '}';
            d($params_enhancer);
            $params_enhancer = str_replace("'", "\"", $params_enhancer);
            $params_enhancer = str_replace("&appostroph;", "'", $params_enhancer);
            $params_enhancer = json_decode($params_enhancer);
            $appname = ucfirst($params_enhancer->appname);
            $ctrl = ucfirst($params_enhancer->controller);
            $action = $params_enhancer->action;
            //creation des nouveaux params
            array_unshift($params, $ctrl, $action);
            $_SERVER['enhancer'] = true;
            //on dispatch dans un tampon
            $boom = new \Boom\Bootstrap($this->request, $this->response);
            $tampon = $boom->dispatch($appname, $params);
            $_SERVER['enhancer'] = false;
            return $tampon;
        }, htmlspecialchars_decode($page->content));
        return $this->view('pages', ['page' => $page], true);
    }
}