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

    function action_sethome($params) // To move in Pages Controller
    {
        if (isset($params[0]) && !empty($params[0])) {
            Data::set('main', ['home' => $params[0]]);
            return $this->response->withRedirect(BASE_URL . "admin/listing/Pages");
        } else {
            error(__('il faut impérativement un id de page ici!'));
        }
    }

    function action_main($params = NULL)
    {
        ///@todo faire en sorte de pouvoir selectionner la page d'accueil. actuellement c'est en dure
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
        }, htmlspecialchars_decode($page->content));
        return $this->view('pages', ['page' => $page], true);
    }
}