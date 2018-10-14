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

        $this->layout = false;
        $product = Product::findOne($id);
        if (!$product){
            return false;
        }

        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product);
        $session->close();
//        pre($session);

        return $this->render('cart-modal', compact('session'));
//        return $product;
    }

    public function actionErase(){

            $session = \Yii::$app->session;
            $session->open();
            $session->remove('cart');
            $session->remove('cart.sum');
            $session->remove('cart.qty');
            $session->close();
            $this->layout = false;
            return $this->render('cart-modal', compact('session'));

            $cart = new Cart();


    }

}
