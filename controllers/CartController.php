<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Order;
use app\models\OrderItems;
use app\models\Product;
use yii\web\Session;

class CartController extends AppController
{
    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionGet()
    {
        $this->layout = false;
        $session = \Yii::$app->session;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionView()
    {
        $session = \Yii::$app->session;
        $session->open();
        $this->setMeta('Корзина');
        $order = new Order();

        if ($order->load(\Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];
            if ($order->save()) {
                $this->saveOrderItems($session['cart'], $order->id);
                \Yii::$app->session->setFlash('success', 'Ваш заказ принят');
                $session->remove('cart');
                $session->remove('cart.sum');
                $session->remove('cart.qty');
                $session->close();
                return $this->refresh();
            }
            \Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
        }

        return $this->render('view', compact('order', 'session'));
    }

    public function actionAdd($id, $qty = 1)
    {
        if (!is_numeric($qty)) {
            return false;
        }


        $this->layout = false;
        $product = Product::findOne($id);
        if (!$product) {
            return false;
        }

        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        $session->close();
        if (!\Yii::$app->request->isAjax) {
            //TODO: сделать обработку количества в запросе не аякс
            return $this->redirect(\Yii::$app->request->referrer);
        }
//        pre($session);

        return $this->render('cart-modal', compact('session'));
//        return $product;
    }

    public function actionErase()
    {

        $session = \Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.sum');
        $session->remove('cart.qty');
        $session->close();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));

    }

    public function actionDelete($id)
    {
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalculate($id);


        $session->close();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    protected function saveOrderItems($items, $order_id)
    {
        foreach ($items as $id => $item) {
            $orderItems = new OrderItems();
            $orderItems->order_id = $order_id;
            $orderItems->product_id = $id;
            $orderItems->name = $item['name'];
            $orderItems->price = $item['price'];
            $orderItems->qty_item = $item['qty'];
            $orderItems->sum_item = $item['qty'] * $item['price'];
            $orderItems->save();



        }

    }

}
