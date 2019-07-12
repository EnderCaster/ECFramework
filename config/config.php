<?php
return [
	'db_host'=>'localhost',
	'db_user'=>'root',
	'db_password'=>'',
	'db_name'=>'endercaster',
	'db_table_prefix'=>'ec_',
	'db_charset'=>'utf8',
	'default_module'=>'home',
	'default_controller'=>'Index',
	'default_action'=>'index',
	'url_type'=> CONFIG_URL_PATHINFO,//TODO add consts normal-1 pathinfo-2
	'cache_path'=>RUNTIME_PATH.'cache'.DS,
	'cache_prefix'=>'cache_',
	'cache_type'=>'file',// This course just implements this type, we can do more
	'url_html_suffix'=>'html'
];