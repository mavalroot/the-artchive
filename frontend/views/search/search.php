<?php
use yii\grid\GridView;
use yii\helpers\Html;

$search_term = Yii::$app->request->get('st') ?: '';
$search = Yii::$app->request->get('src') == 'pj' ? Yii::t('frontend', 'Personaje') : Yii::t('frontend', 'Usuario');
$this->title = Yii::t('frontend', 'Buscar') . " $search: \"$search_term\"";
$this->params['breadcrumbs'][] = $this->title;

?>

<h1 class="title-index"><?= Html::encode($this->title) ?></h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $columnas,
]); ?>
