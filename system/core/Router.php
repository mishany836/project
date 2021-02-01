<?php


class Router
{
public static $routers = []; // таблица маршрутов
public  static $route = []; // текущий маршрут

    /**
     *  добавляет маршрут в данную таблицу маршрутов
     * @param $route
     */
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
            self::$route = $route;
          return true;
        }
    }
    return false;
}

    /**
     * @param $path
     */
public static function dispatch($path)
    {
if (self::checkRoute($path)){
    $controller = '\app\controllers\\' .  self::$route['controller'] . 'Controller';
    if (class_exists($controller)){
        $obj = new $controller;
    }else{
        echo  'Контроллер ' . $controller . ' не найден';
    }
}else{
    echo  '404';
}
      }

    /**
     * преобразует строку в нужный для нас вид
     * @param $str
     * @return mixed|string
     */
      private static function uStr($str)
      {
          $str = str_replace('-', ' ', $str);
          $str = ucwords($str);
          $str = str_replace(' ', '', $str);
          pr($str);
          return $str;
      }

}