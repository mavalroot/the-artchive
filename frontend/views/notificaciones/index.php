<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NotificacionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notificaciones';
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->user->identity->setSeenAllAlerts();
?>
<div class="notificaciones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'notificacion',
                'format' => 'html'
            ],
            'tipo_notificacion_id',
            'created_at:relativetime',
        ],
    ]); ?>
</div>
