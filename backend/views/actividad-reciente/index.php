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
        'columns' => [
            [
                'attribute' => 'creator',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->getUrlCreator();
                }
            ],
            [
                'attribute' => 'mensaje',
                'format' => 'html',
                'value' => function ($model) {
                    if (isset($model->referencia, $model->tipo)) {
                        return Html::a($model->mensaje, ["{$model->tipo}/view", 'id' => $model->referencia]);
                    }
                    return $model->mensaje;
                }
            ],
            'created_at:datetime',
        ],
    ]); ?>
</div>
