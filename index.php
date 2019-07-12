<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH',__DIR__.DS);
define('CONFIG_URL_PATHINFO',2);
define('CONFIG_URL_NORMAL',1);
// require 'sys/start.php';
// core\App::run();
var_dump(parse_url($_SERVER['REQUEST_URI']));