<?php
namespace Apps\Pages\Ctrl;

use Boom\Ctrl\Controller;

class Pages extends Controller {
    function exist($name) {
        //c'est du statique c'est moche

    }

    function action_main($params = NULL) {
        $page = $this->Page->find(1);

        $pattern = '/<enhancer .*">.*<\/enhancer>/';
        $page->content = preg_replace_callback($pattern, function ($matches) {
            $params = '{'.GetBetween("data-params=\"{", "}\"", $matches[0]).'}';
            d($params);
            $params = str_replace("&quot;", "\"", $params);
            $params = json_decode($params);
            $ctrl = 'ctrl';
            $response = 'action';//$ctrl->{'action_'. 'blabla'}();
            return d($params);
        }, htmlspecialchars_decode($page->content));
        return $this->view('pages', ['page' => $page]);
    }
}