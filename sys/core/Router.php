<?php
namespace core;
class Router{
	public $url_query;
	public $url_type;
	public $route_url=[];

	function __construt(){
		$this->url_query=parse_url($_SERVER['REQUEST_URI']);
	}
	public function setUrlType($url_type=CONFIG_URL_PATHINFO){
		if($url_type>0&&$url_type<3){
			$this->url_type=$url_type;
			return $url_type;
		}
		exit('404 url type not found');
	}
	public function getUrlArray(){
		$this->makeUrl();
		return $this->route_url;
	}
	public function makeUrl(){
		if($this->url_type==CONFIG_URL_PATHINFO){
			return $this->pathinfoToArray();
		}
		if($this->url_type==CONFIG_URL_NORMAL){
			return $this->queryToArray();
		}
	}
	/**
	* start with ?
	*/
	public function queryToArray(){
		$parameters=array_key_exists('query',$this->url_query)?$this->url_query['query']:[];
		$require_array=['module','controller','action'];
		if(count($parameters)>0){
			$route_url=[];
			foreach ($parameters as $parameter) {
				$tmp=explode('=', $parameter);
				if (!array_search($tmp[0], $require_array)) {
					continue;
				}
				$route_url[$tmp[0]]=$tmp[1];
			}
			foreach ($require_array as $require_parameter) {
				if(array_key_exists($require_parameter, $route_url)){
					$route_url[$require_parameter]=Config::get('default_'.$require_parameter);
				}
			}
		}

		$this->route_url=[];
		return $this->route_url;
	}

	/**
	* require rewrite module
	*/
	public function pathinfoToArray(){

	}
}