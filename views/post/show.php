<?php
use app\components\MyWidget;
?>

<?php $this->beginBlock('block1') ?>
<?= $page ?><br>
<?php $this->endBlock() ?>


<?php echo MyWidget::widget(['name' => 'Maxim']);
//dump($cats);
//foreach ($cats as $cat) {
//    echo $cat->title . '<br>';
//} ?>