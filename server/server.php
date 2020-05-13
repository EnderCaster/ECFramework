<?php
define("APP_ROOT",dirname(dirname(__FILE__)).'/');
$config=include APP_ROOT."config.php";

$http = new Swoole\Http\Server($config['server']['host'], $config['server']['port']);

$http->on("start", function ($server) {
    echo "Swoole http server is Listening at http://{$server->host}:{$server->port}\n";
});

$http->on("request", function ($request, $response) {
    require_once APP_ROOT."vendor/autoload.php";
    $response->header("Content-Type", "text/plain");
    $controller=new App\Controller\TestController();
    $response->end($controller->hello());
});

$http->start();