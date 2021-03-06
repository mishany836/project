<?php
namespace system\core;

class Router
{

public static $routers = []; // таблица маршрутов
public  static $route = []; // текущий маршрут

public static function add($route)
{
    foreach ($route as $k => $val) {
        self::$routers[$k] = $val;
    }
}

    /**
     *  метод проверяет совпадения с таблицей маршрутов
     * @param $url - адресная строка
     * @return bool
     */
public static function checkRoute($url)
{
    $url = self::removeQueryString($url);
    foreach (self::$routers as $k => $val){

        if (preg_match("#$k#i", $url, $matches)){

           // pr($val);
            $route = $val;
          foreach ($matches as $key => $match){
              if (is_string($key)){
                  $route[$key] = $match;
              }
            }

          $route['controller'] = self::uStr($route['controller']);
          if (!isset($route['action'])){
              $route['action'] = 'index';
          }

          if (!isset($route['prefix'])){
              $route['prefix'] = '';
          }
          //pr($route);
            self::$route = $route;
          return true;
        }
    }
    return false;
}

public static function dispatch($path)
    {
if (self::checkRoute($path)){

    $controller = '\app\controllers\\' .self::$route['prefix'] . self::$route['controller'] . 'Controller';

   // echo $controller;


 if (class_exists($controller)){


        $obj = new $controller(self::$route);
        $action = self::lStr(self::$route['action']) . 'Action';

        if (method_exists($obj, $action)) {
            if (isset(self::$route['id'])) {
                $obj->$action(self::$route['id']);
            } else {
            $obj->$action();
            }
        $obj->getView();
        }else{
            echo 'Метод ' . $action . ' не найден';
        }
    }else{
        echo  'Контроллер ' . $controller . ' не найден';
    }
}else{
    http_response_code(404);
    include '404.html';
}
      }

  private static function uStr($str)
      {
          $str = str_replace('-', ' ', $str);
          $str = ucwords($str);
          $str = str_replace(' ', '', $str);
          return $str;
      }
private static function lStr($str){
   return lcfirst(self::uStr($str));
}

private static function removeQueryString($url)
{
    if ($url != ''){
      $params = explode('&', $url);
      if (strpos($params[0], '=') === false){
          return $params[0];
      }else{
          return '';
      }
    }

   return $url;
}
}