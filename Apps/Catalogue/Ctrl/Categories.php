<?php
namespace Apps\Catalogue\Ctrl;

use Boom\Ctrl\Controller;

class Categories extends Controller
{
    function exist($name)
    {
        //c'est du statique c'est moche
    }

    function action_main($params)
    {
        echo 'action main : catégorie = ' . $params[0];
    }
}