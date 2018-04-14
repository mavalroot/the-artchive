<?php
use yii\grid\GridView;
use yii\helpers\Html;

$search_term = Yii::$app->request->get('s') ?: '';
$search = Yii::$app->request->get('t') == 'pj' ? 'Personaje' : 'Usuario';
$this->title = "Buscar $search: \"$search_term\"";
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php

if (isset($dataProvider, $columnas)) {
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $columnas,
    ]); ?>
    <?php
}
