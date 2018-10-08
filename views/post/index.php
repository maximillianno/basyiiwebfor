<?php // dump($model)
use mihaildev\ckeditor\CKEditor;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <?php echo (Yii::$app->session->getFlash('success')); ?>
</div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error')): ?>
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <?= Yii::$app->session->getFlash('error') ?>
</div>


<?php endif; ?>
<h1>Статьи</h1>
<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'name')->label('Имя') ?>
<?= $form->field($model, 'email')->input('email') ?>
<?= yii\jui\DatePicker::widget(['name' => 'datePicker']) ?>
<?= $form->field($model, 'text')->widget(CKEditor::className(),[
    'editorOptions' => [
        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        'inline' => false, //по умолчанию false
    ],
]); ?>
<?//=  $form->field($model, 'text')->label('Текст сообщения')->textarea(['rows' => 5]) ?>
<?= Html::submitButton('Send', ['class' => 'btn btn-success', 'id' => 'btn']) ?>
<?php ActiveForm::end() ?>
