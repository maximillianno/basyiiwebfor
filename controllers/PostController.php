<?php
/**
 * Created by PhpStorm.
 * User: maxus
 * Date: 02.10.2018
 * Time: 10:59
 */

namespace app\controllers;


use app\models\Category;
use app\models\TestForm;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\Controller;

class PostController extends AppController
{

//    public $layout = 'basic';
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax){
            \dump(\Yii::$app->request->post());
//            return 'ajax';
            exit;
        }

        $this->layout = 'basic';
        $page = 'articles';

        $this->view->title = $page;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => 'words']);
        $this->view->registerMetaTag(['name' => 'description', 'content' => 'article description']);

        $model = new TestForm();

//        $model->name = 'Author';
//        $model->email = 'mail@mail.com';
//        $model->text = 'my text';
//        $model->save();

        if ($model->load(\Yii::$app->request->post())){
            if ($model->save()){
                \Yii::$app->session->setFlash('success', "Принято");
//                \dump(\Yii::$app->request->post());
                return $this->refresh();
            } else {
                \Yii::$app->session->setFlash('error', 'Ошибка валидации на сервере');

            }
        }


        return $this->render('index', compact('page', 'model'));
    }

    public function actionShow()
    {
        $this->layout = 'basic';
        $page = 'article';
        $this->view->title = $page;
//        $cats = Category::find()->asArray()->where(['parent' => 685])->all();
        $cats = Category::findOne(['parent' => 685]);



        return $this->render('show', compact('page', 'cats'));

    }

}