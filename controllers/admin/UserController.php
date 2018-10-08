<?php
/**
 * Created by PhpStorm.
 * User: maxus
 * Date: 02.10.2018
 * Time: 10:47
 */
namespace app\controllers\admin;



use app\controllers\AppController;

class UserController extends AppController
{
    public function actionIndex(){
        return $this->render('index');
    }

}