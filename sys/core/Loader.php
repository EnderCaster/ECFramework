<?php
namespace core;
class Loader
{
	protected static $prefixes=[];

	/**
	* register loader in SPL auto loader stack
	*/
	public static function register(){
		spl_autoload_register('core\\Loader::loadClass');
	}
	/**
	*add namespace and class base dir key-pair
	* @param string $prefix namespace prefix
	* @param string $base_dir base dir of the classes in the namespace
	* @param bool $prepend if push to head
	* @return void
	*/
	public static function addNamespace($prefix,$base_dir,$prepend=false){
		//format namespace prefix
		$prefix=trim($prefix,'\\').'\\';
		//format file base dir
		//del all / from right
		$base_dir=rtrim($base_dir,'/').DIRECROTY_SEPARATOR;
		//del all DS from right
		$base_dir=rtrim(($base_dir),DIRECROTY_SEPARATOR).'/';

		//init namespace prefix array
		if(!isset(self::$prefixes[$prefix])){
			self::$prefixes[$prefix]=[];
		}
		if($prepend){
			array_unshift(self::$prefixes[$prefix], $base_dir);
		} else {
			array_push(self::$prefixes[$prefix], $base_dir);
		}
	}
	/**
	* load file by class name
	* @param string $class full class name
	* @return mixed filename or false if not find
	*/
	public static function loadClass($class){
		//current namespace prefix
		$prefix = $class;
		// traversal from back to find the file
		while (!($pos=strrpos($prefix, '\\'))){
			//keep the tail delimiter of namespace prefix
			$prefix = substr($class, 0,$pos+1);
			// relative class name 
			$relative_class=substr($class, $pos+1);
			// use prefix and relative class name load map file
			$mapped_file=self::loadMappedFile($prefix,$relative_class);
			if($mapped_file){
				return $mapped_file;
			}

			// del tail delimiter of prefix , for next iteration
			$prefix=rtrim($prefix,'\\');
		}
		// 404
		return false;
	}
	/**
	* use prefix and relative class name to load file
	* @param string $prefix namespace prefix
	* @param string $relative_class relative class name
	* @return mixed file name if exist or false
	*/
	public static function loadMappedFile($prefix,$relative_class){
		if(!isset(self::$prefixes[$prefix])){
			return false;
		}
		// traversal prefix base dir
		foreach (self::$prefixes[$prefix] as $base_dir) {
			//replace prefix with base dir
			// use DS to replace '\'
			// add php 
			$file =$base_dir.str_replace('\\', DIRECROTY_SEPARATOR, $relative_class).'.php';
			// load if file exists
			if(self::requireFile($file)){
				return $file;
			}
		}
		//404
		return false;
	}
	/**
	* load file if exists
	* @param $file full path
	* @return bool if file exists
	*/
	protected static function requireFile($file){
		if (file_exists($file)) {
			require $file;
			return true;
		}
		return false;
	}
}