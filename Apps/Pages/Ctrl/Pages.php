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
        $results = preg_replace_callback($pattern, function ($matches) {
            d($matches);
            return 'enhancer remplacé';
        }, $page->content);
        d($results);
        return $this->view('pages', ['page' => $page]);
    }
}