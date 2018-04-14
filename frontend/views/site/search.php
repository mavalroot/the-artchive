<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = "Search";
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php

if ($dataProvider) {
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $columnas,
    ]); ?>
    <?php
}
