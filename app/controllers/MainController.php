<?php
namespace app\controllers;
use app\models\News;
use system\core\Controller;

class MainController extends Controller
{

    public $layout = 'main';
    public function indexAction()
    {
        $news = new News();
        $arNews = $news->findOne("текст новости3", 'text');
        pr($arNews);
        $this->view = 'test';
        $arr = [
            'n1' => 1,
            'n2' => 2
        ];

        //echo 'News::index';
       // $this->view = 'test';
        $this->setVars(['name' => 'vasya', 'arArray' => $arr]);
    }
    public function testAction()
    {
        //echo 'News::test';
    }
    public function check()
    {

    }
}