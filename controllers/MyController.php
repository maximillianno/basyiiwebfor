<?php
/**
 * Created by PhpStorm.
 * User: maxus
 * Date: 02.10.2018
 * Time: 9:23
 */

namespace app\controllers;




class MyController extends AppController
{
    public function actionIndex($id = null){
        $names = ['first', 'second'];
        return $this->render('index', compact('names', 'id'));
    }
    public function actionBlogPost(){
        return 'blog post';
    }

}