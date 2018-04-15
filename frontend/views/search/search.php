<?php
use yii\grid\GridView;
use yii\helpers\Html;

$search_term = Yii::$app->request->get('st') ?: '';
$search = Yii::$app->request->get('src') == 'pj' ? 'Personaje' : 'Usuario';
$this->title = "Buscar $search: \"$search_term\"";
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode($this->title) ?></h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $columnas,
]); ?>
