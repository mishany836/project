<?php


namespace app\controllers;


use system\core\Controller;

class AppController extends Controller
{
    protected $layout = 'admin';
    public function __construct($route, $view = '')
    {
        parent::__construct($route, $view);
        if (!isset($_SESSION['is_admin']) && $route['action'] != 'login'){
            header('Location: /admin/login');
        }
    }
}