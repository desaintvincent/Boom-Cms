<?php
namespace Apps\Catalogue\Ctrl;

use Boom\Ctrl\Controller;

class Products extends Controller
{

    function action_main($params = null)
    {
        if ($params) {
            return $this->response->write('action main : product = ' . $params[0]);
        }
    }
}