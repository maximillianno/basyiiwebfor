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
    public function dd($arr){
        VarDumper::dump($arr, 10,true);
//        echo '<pre>'. print_r($arr, true). '</pre>';
        exit;
    }
}
function dump($arr){
            VarDumper::dump($arr, 10,true);
}

