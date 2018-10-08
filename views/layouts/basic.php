<?php
use yii\helpers\Html;
\app\assets\AppAsset::register($this) ?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= Html::csrfMetaTags() ?>
    <title><?= $this->title ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<div class="wrap">

    <div class="container">
        <ul class="nav nav-pills">
            <li role="presentation" class="<?=  $this->title === 'home' ? 'active' : '' ?>"><?= Html::a('Главная', '/') ?></li>
            <li role="presentation" class="<?=  $this->title === 'articles' ? 'active' : '' ?>"><?= Html::a('Статьи', ['/post/index']) ?></li>
            <li role="presentation" class="<?=  $this->title === 'article' ? 'active' : '' ?>"><?= Html::a('Статья', ['/post/show']) ?></li>
        </ul>
        <?php if (isset($this->blocks['block1'])) echo $this->blocks['block1'] ?>
    <?= $content ?>
    </div>
</div>




<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>