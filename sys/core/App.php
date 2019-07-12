<?php
namespace core;
use core\Config;
use core\Router;
class App{
	public static $router;
	public static function run(){
		self::$router=new Router();
		self::$router->setUrlType(Config::get('url_type'));
		$url_array=slef::$router->getUrlArray();
		self::dispatch($url_array);
	}
	public static function dispatch($url_array=[]){
		$module=isset($url_array['module'])?$url_array['module']:Config::('default_module');
		$controller=isset($url_array['controller'])?ucfirst($url_array['controller']):ucfirst(Config::('default_controller'));
		$action=isset($url_array['action'])?$url_array['action']:Config::('default_action');
		$controller_file=APP_PATH.$module.DS.'controller'.DS.$controller.'.php';
		if(file_exists($controller_file)){
			require $controller_file;
			$class_name="$module\\controller\\$controller"."Controller";
			$controller=new $class_name;
			if (method_exists($controller, $action)) {
				$controller->setTpl($action);
				$controller->$action();
			}else{
				die('404 action');
			}
		} else {
			die('404 controller');
		}

	}
}