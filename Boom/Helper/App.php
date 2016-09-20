<?php

namespace Boom\Helper;

class App
{
	public static function exist($appname)
	{
		return (is_dir('./Apps/' . ucfirst($appname)));
	}

	public static function getConfig($appname)
	{
		$appname = ucfirst($appname);
        $config_path = "./Apps/" . $appname . '/Config/' . $appname . '.php';
        if (file_exists($config_path)) {
            $config = require $config_path;
        } else {
            error($appname . '\'s config doesn\'t exist');
            $config = null;
        }


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

		return method_exists($namespace, 'action_' . $action);
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
			} elseif (isset($config['default_ctrl']) && !empty($config['default_ctrl'])) {
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
			} elseif (isset($config['default_action']) && !empty($config['default_action'])) {
				$action = $config['default_action'];
			}
		}

		return 'action_' . $action;
	}

	public static function getAllEnhancersConfig($appname)
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
			&& !empty($config['enhancers'][$enhancername])
		) {
			return $config['enhancers'][$enhancername];
		} else {
			echo "Enhancer $enhancername doesn't exit!";
		}
	}

    public static function getApps()
    {
        $appList = array();
        if ($handle = opendir('Apps')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry[0] != '.' && $entry != 'Admin') {
                    $appList[] = $entry;
                }
            }
            closedir($handle);
            $apps = [];
            foreach ($appList as $i => $app) {
                $conf = App::getConfig($app);
                $apps[$i]['name'] = $app;
                if (isset($conf['default_crud'])) {
                    $apps[$i]['crud'] = $conf['default_crud'];
                } else {
                    $apps[$i]['crud'] = $app;
                }
            }
            return $apps;
        } else {
            die('impossible d\'ouvrir le dossier des applications');
        }
    }

    public static function getAppsRequired()
    {
        $appList = array();
        if ($handle = opendir('Apps')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry[0] != '.' && $entry != 'Admin') {
                    $appList[] = $entry;
                }
            }
            closedir($handle);
            $apps = [];
            foreach ($appList as $i => $app) {
                $conf = App::getConfig($app);
                if (isset($conf['required']) && $conf['required']) {
                    $apps[$i]['name'] = $app;
                    if (isset($conf['default_crud'])) {
                        $apps[$i]['crud'] = $conf['default_crud'];
                    } else {
                        $apps[$i]['crud'] = $app;
                    }
                }
            }
            return $apps;
        } else {
            die('impossible d\'ouvrir le dossier des applications');
        }
    }

    public static function getAppsNotRequired()
    {
        $appList = array();
        if ($handle = opendir('Apps')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry[0] != '.' && $entry != 'Admin') {
                    $appList[] = $entry;
                }
            }
            closedir($handle);
            $apps = [];
            foreach ($appList as $i => $app) {
                $conf = App::getConfig($app);
                if (!isset($conf['required']) || (isset($conf['required']) && !$conf['required'])) {
                    $apps[$i]['name'] = $app;
                    if (isset($conf['default_crud'])) {
                        $apps[$i]['crud'] = $conf['default_crud'];
                    } else {
                        $apps[$i]['crud'] = $app;
                    }
                }
            }
            return $apps;
        } else {
            die('impossible d\'ouvrir le dossier des applications');
        }
    }

    public static function getAllApps()
    {
        return [
            'required' => self::getAppsRequired(),
            'not_required' => self::getAppsNotRequired()
        ];
    }

    public static function getAllEnhancers() {
        $result = [];
        $apps = self::getApps();
        foreach ($apps as $app) {
            $enhancers = self::getAllEnhancersConfig($app['name']);
            if (!empty($enhancers)) {
                $result = array_merge($enhancers);
            }
        }
        return $result;
    }
}