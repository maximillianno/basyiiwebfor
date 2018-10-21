<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\web\Session;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AppAdminController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
//        $this->layout = 'admin';
//        $session =\Yii::$app->user->identity->validateAuthKey('');
//        dd($session);
        return $this->render('index');
    }
}
