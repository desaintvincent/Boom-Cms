<?php
namespace Apps\Menu\Ctrl;

use Apps\Pages\Model\Page;
use Boom\Ctrl\Controller;

class Menu extends Controller
{
    function action_ajax($params = null)
    {
        if (!isset ($params[0]) || empty($params[0])) return;
        $modelPage = New \Apps\Pages\Model\Page();
        $pages = $modelPage->find('all', [
            'where' => [
                'title' => ['like', '%' . $params[0] . '%']
            ],
            'limit' => 10,
        ]);
        echo json_encode($pages);
    }
}