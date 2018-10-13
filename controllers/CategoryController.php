<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use yii\data\Pagination;
use yii\web\HttpException;

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
        $category = Category::findOne($id);
        if(!$category) {
            throw new HttpException(404, 'Такой категории нет.');
        }
        $query = Product::find()->where(['category_id' => $id]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

//        $products = Product::find()->where(['category_id' => $id])->all();
        $this->setMeta('E-shopper | '. $category->name, $category->keywords, $category->description);
//        $hits = Product::find()->where('hit=1')->limit(6)->all();
        return $this->render('view', compact('products', 'category', 'pages'));

    }
    public function actionSearch($q)
    {
        $q = trim($q);
        if(!$q){
            return $this->render('search', ['pages' => '', 'products' => '', 'q' => $q]);
        }

//        dd($q);
        $query = Product::find()->where(['like', 'name', $q]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

//        $products = Product::find()->where(['category_id' => $id])->all();
        $this->setMeta('E-shopper | search', 'Search', 'Search');
//        $hits = Product::find()->where('hit=1')->limit(6)->all();
        return $this->render('search', compact('products', 'pages', 'q'));
    }

}
