<?php
require_once '../system/core/functions.php';
require_once '../system/core/Router.php';
require_once '../app/controllers/MainController.php';
require_once '../app/controllers/PageController.php';



$o = new \app\controllers\MainController;
$qStr = $_SERVER['QUERY_STRING'];




//Router::add(['news/view'=> ['controller' => 'index', 'action' => 'view']]);
//Router::add(['news'=> ['controller' => 'news', 'action' => 'index']]);
//Router::add(['page/about'=> ['controller' => 'page', 'action' => 'about']]);

Router::add(['^$'=> ['controller' => 'Main', 'action' => 'index']]);
Router::add(['^(?P<controller>[a-z0-9-]+)/?(?P<action>[a-z0-9-]+)?$' => []]);
pr(Router::$routers);
Router::dispatch($qStr);

