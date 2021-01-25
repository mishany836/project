<?php
namespace app\controllers;
use system\core\Controller;

class MainController extends Controller
{

    public $layout = 'main';
    public function indexAction()
    {
        $arr = [
            'n1'
        ];

        //echo 'Main::index';
       // $this->view = 'test';
        $this->setVars(['name' => 'vasya', 'arArray' => $arr]);
    }
    public function testAction()
    {
        //echo 'Main::test';
    }
    public function check()
    {

    }
}