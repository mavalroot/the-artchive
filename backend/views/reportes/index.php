<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReportesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Reportes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'tipo',
            [
                'attribute' => 'creator',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->getUrlCreator();
                }
            ],
            [
                'attribute' => 'referencia',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->getUrl();
                }
            ],
            'referencia',
            'estado',
            'created_at:datetime',
        ],
    ]); ?>
</div>
