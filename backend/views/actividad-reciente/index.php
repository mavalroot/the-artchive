<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ActividadRecienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actividad Recientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-reciente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'creator',
            [
                'attribute' => 'mensaje',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->url) {
                        return "<a href=\"$model->url\">$model->mensaje</a>";
                    }
                    return $model->mensaje;
                }
            ],
            'created_at:datetime',
        ],
    ]); ?>
</div>
