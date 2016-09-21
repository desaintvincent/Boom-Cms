<?php
namespace Apps\Pages\Ctrl;

use Boom\Ctrl\Controller;
use Boom\Helper\App;

class Pages extends Controller {
    function exist($name) {
        //c'est du statique c'est moche

    }

    function action_main($params = NULL) {
        ///@todo faire en sorte de pouvoir selectionner la page d'accueil. actuellement c'est en dure
        $accueil = 'page1';

        //1st param is for page of course
        $page = $this->Page->find('first', ['where' => ['slug' => $params[0] ]]);
        if (!empty($page)) {
            //si on trouve la page, on retire le nom de la page des params
            define('URL_PAGE', $params[0]);
            array_shift($params);
        } else {
            //on cherche la page d'accueil
            //je sais pas comment gerer le 404 du coup :/
            $page = $this->Page->find('first', ['where' => ['slug' => $accueil ]]);

            define('URL_PAGE', $accueil);
        }

        $pattern = '/<enhancer .*">.*<\/enhancer>/';
        $page->content = preg_replace_callback($pattern, function ($matches) use ($params){
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
        }, htmlspecialchars_decode($page->content));
        return $this->view('pages', ['page' => $page], true);
    }
}