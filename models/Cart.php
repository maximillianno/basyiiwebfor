<?php

namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class TestForm
 * @package app\models
 */
class Cart extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    public function addToCart($product, $qty = 1)
    {


        if (isset($_SESSION['cart'][$product->id])){

            $_SESSION['cart'][$product->id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$product->id] = [
                'qty' => $qty,
                'name' => $product->name,
                'price' => $product->price,
                'img' => $product->img,
            ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $product->price * $qty : $product->price * $qty;


        return;

    }

    public function recalculate($id)
    {
        if (!isset($_SESSION['cart'][$id])){
            return false;
        }
        if ($_SESSION['cart'][$id]['qty'] == 1){
            $_SESSION['cart.qty'] = $_SESSION['cart.qty'] - 1;
            $_SESSION['cart.sum'] = $_SESSION['cart.sum'] - $_SESSION['cart'][$id]['price'];
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id]['qty']--;
            $_SESSION['cart.qty'] = $_SESSION['cart.qty'] - 1;
            $_SESSION['cart.sum'] = $_SESSION['cart.sum'] - $_SESSION['cart'][$id]['price'];

        }

    }


}