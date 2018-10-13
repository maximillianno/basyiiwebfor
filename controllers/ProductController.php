<?php

namespace app\controllers;

use app\models\Product;
use yii\web\HttpException;

class ProductController extends AppController
{
    public function actionView($id)
    {
//        $product = Product::findOne($id);

        //На 1 запрос меньше
        $product = Product::find()->with('category')->where(['id' => $id])->limit(1)->one();
        if (!$product){
            throw new HttpException(404, 'Такого товара нет');
        }
        $hits = Product::find()->where('hit=1')->limit(6)->all();
        $this->setMeta('E-Shopper | '. $product->name, $product->keywords, $product->description);
        return $this->render('view', compact('product', 'hits'));
    }

}
