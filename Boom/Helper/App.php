<?php

namespace Boom\Helper;

class App {
    public static function exist($appname)
    {
        return (is_dir('./Apps/'.ucfirst($appname)));
    }

    public static function getConfig($appname)
    {
        $appname = ucfirst($appname);
        $config = require_once "./Apps/" . $appname . '/Config/' . $appname . '.php' ;

        return $config;
    }

    public static function isAppCtrl($appname, $ctrlname)
    {
        $ctrlname = ucfirst($ctrlname);
        $namespace = '\Apps\\' . $appname . '\Ctrl\\' . $ctrlname;

        return class_exists($namespace);
    }

    public static function isCtrlAction($appname, $ctrl, $action)
    {
        $namespace = 'Apps\\' . $appname . '\Ctrl\\' . $ctrl;

        return method_exists($namespace, 'action_'.$action);
    }

    public static function getCtrlFromRoute($appname, &$params)
    {
        $appname = ucfirst($appname);
        $config = self::getConfig($appname);
        $ctrl = $appname;

        if (isset($params[0])) {
            if (self::isAppCtrl($appname, $params[0])) {
                $ctrl = $params[0];
                array_shift($params);
            } elseif (isset($config['default_ctrl']) && !empty($config['default_ctrl'])){
                $ctrl = $config['default_ctrl'];
            }
        }

        return ucfirst($ctrl);
    }

    public static function getActionFromRoute($appname, $ctrl, &$params)
    {
        $appname = ucfirst($appname);
        $config = self::getConfig($appname);
        $action = 'main';

        if (isset($params[0])) {
            if (self::isCtrlAction($appname, $ctrl, $params[0])) {
                $action = $params[0];
                array_shift($params);
            } elseif (isset($config['default_action']) && !empty($config['default_action'])){
                $action = $config['default_action'];
            }
        }

        return 'action_'.$action;
    }

	public static function getEnhancersConfig($appname)
	{
		$config = self::getConfig($appname);

		if (isset($config['enhancers']) && !empty($config['enhancers'])) {
			return $config['enhancers'];
		}
	}

	public static function getEnhancerConfig($appname, $enhancername)
	{
		$config = self::getConfig($appname);

		if (isset($config['enhancers'])
			&& !empty($config['enhancers'])
			&& isset($config['enhancers'][$enhancername])
			&& !empty($config['enhancers'][$enhancername])) {
			return $config['enhancers'][$enhancername];
		} else {
			echo "Enhancer $enhancername doesn't exit!";
		}
	}
}