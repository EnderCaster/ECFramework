<?php
namespace core;
class Config{
	private static $config=[];
	public static function get($name=null){
		if (empty($name)) {
				return self::$config;
		}
		//TODO if we wanna use tree config ,we have to change there to another way
		// origin course use str to lower case to precess the $name , but this way will cause a bug that when you use set method below and the name is start with an upper case word
		return array_key_exists($name, self::$config)?self::$config[$name]:null;
	}
	public static function set($name,$value=null){
		if(is_string($name)){
			self::$config[$name]=$value;
			return self::get($name);
		}
		// batch set
		if(is_array($name)){
			foreach ($name as $one_name=>$one_value) {
				self::$config[$one_name]=$one_value;
			}
			return $name;
		}
		//key error, return all
		return self::$config;
	}
	public static function has($name){
		return array_key_exists($name, self::$config);
	}
	public static function load($file){
		if (is_file($file)) {
			$type=pathinfo($file,PATHINFO_EXTENSION);
			if($type!='php'){
				return self::$config;
			}
			return self::set(include $file);
		}
		return self::$config;
	}
}