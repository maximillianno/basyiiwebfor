<?php

use yii\helpers\VarDumper;

function dd($arr){
    echo '<pre>'. print_r($arr, true). '</pre>';
//    VarDumper::dump($arr, 10,true);
    exit;
}
function pre($arr){
    echo '<pre>'. print_r($arr, true). '</pre>';
    exit;
//    VarDumper::dump($arr, 10,true);
}
