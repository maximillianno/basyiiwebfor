<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?php //echo $form->field($model, 'category_id')->textInput() ?>
<!--    TODO: переделать на виджет -->
    <?= $form->field($model, 'category_id')->dropDownList(array_map(function($res){ return $res['name']; },\app\models\Category::find()->indexBy('id')->all())) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'content')->widget(\mihaildev\ckeditor\CKEditor::className(),[
        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder',[
            'preset' => 'basic', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ]),

    ]); ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'img')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'hit')->checkbox([ '0', '1' ]) ?>

    <?= $form->field($model, 'new')->checkbox([ '0', '1' ]) ?>

    <?= $form->field($model, 'sale')->checkbox([ '0', '1' ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
