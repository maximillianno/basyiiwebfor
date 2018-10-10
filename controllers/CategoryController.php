<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use yii\data\Pagination;

class CategoryController extends AppController
{
    public function actionIndex()
    {
        $hits = Product::find()->where('hit=1')->limit(6)->all();
//        dd($hits);
        $this->setMeta('E-shopper');
        return $this->render('index', compact('hits'));
    }

    public function actionView($id)
    {
        $query = Product::find()->where(['category_id' => $id]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

//        $products = Product::find()->where(['category_id' => $id])->all();
        $category = Category::findOne($id);
        $this->setMeta('E-shopper | '. $category->name, $category->keywords, $category->description);
//        $hits = Product::find()->where('hit=1')->limit(6)->all();
        return $this->render('view', compact('products', 'category', 'pages'));

    }

}
