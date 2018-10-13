<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use yii\web\Session;

class CartController extends AppController
{
    public function actionIndex()
    {

        return $this->render('index');
    }
    public function actionAdd($id){
        $product = Product::findOne($id);
        if (!$product){
            return false;
        }

        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product);

        return;
//        return $product;
    }

}
