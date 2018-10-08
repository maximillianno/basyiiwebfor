<?php

use yii\helpers\VarDumper;

function dd($arr){
    VarDumper::dump($arr, 10,true);
    exit;
}
function dump($arr){
//    echo '<pre>'. print_r($arr, true). '</pre>';
    VarDumper::dump($arr, 10,true);
}
