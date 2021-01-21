<?php
require_once '../system/core/functions.php';


use system\core\Router;


$qStr = $_SERVER['QUERY_STRING'];

define("ROOT", '../');

//pr($_GET);

spl_autoload_register(function($class){
    $class = ROOT . str_replace('\\', '/', $class) . '.php';
    echo $class;
    if (file_exists($class)){

        include $class;
    }
    echo $class;
});


//Router::add(['news/view'=> ['controller' => 'index', 'action' => 'view']]);
//Router::add(['news'=> ['controller' => 'news', 'action' => 'index']]);
//Router::add(['page/about'=> ['controller' => 'page', 'action' => 'about']]);
Router::add(['^(?P<controller>[a-z0-9-]+)/?(?P<action>[a-z0-9-]+)/(?P<alias>[a-z0-9-]+)$' => []]);

Router::add(['^$'=> ['controller' => 'Main', 'action' => 'index']]);
Router::add(['^(?P<controller>[a-z0-9-]+)/?(?P<action>[a-z0-9-]+)?$' => []]);


//pr(Router::$routers);
Router::dispatch($qStr);

