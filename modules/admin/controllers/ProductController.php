<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->with('category'),
        ]);

        Yii::$app->view->params['active'] = 'products';

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        Yii::$app->view->params['active'] = 'products';
        $model = $this->findModel($id);
        $image = $model->getImage();
//        dd($image);
        return $this->render('view', [
            'model' => $model,
//            'image' => $image
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::$app->view->params['active'] = 'products';
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Товар {$model->name} добавлен");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        Yii::$app->view->params['active'] = 'products';
        $model = $this->findModel($id);
        $model->img = 'no-image.png';

//        dd(UploadedFile::getInstance($model, 'image'));
            $model->image = UploadedFile::getInstance($model, 'image');
            $model->gallery = UploadedFile::getInstances($model, 'gallery');
            if(!empty($model->image) || !empty($model->gallery)){
                $model->removeImages();
            }
            if (!empty($model->image)){
                $model->upload();
            }
            if (!empty($model->gallery)){
                $model->uploadGallery();
            }

//            dd($model);
        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            Yii::$app->session->setFlash('success', "Товар {$model->name} обновлен");
            return $this->redirect(['view', 'id' => $model->id]);
        }

//        dd($model);
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Yii::$app->view->params['active'] = 'products';
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
