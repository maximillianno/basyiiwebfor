<?php
/**
 * Created by PhpStorm.
 * User: maxus
 * Date: 02.10.2018
 * Time: 10:58
 */

namespace app\controllers;


use yii\helpers\VarDumper;
use yii\web\Controller;

class AppController extends Controller
{
    protected function setMeta($title = '', $keywords = '', $description = '')
    {
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $keywords]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $description]);
    }


}


