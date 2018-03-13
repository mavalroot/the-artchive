<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MensajesPrivadosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inbox';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensajes-privados-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Enviar mensaje privado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'emisor_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->getEmisor()->one()->username, $model->getEmisor()->one()->getUrl());
                }
            ],
            'asunto',
            // 'contenido:ntext',
            //'visto:boolean',
            //'leido:boolean',
            'created_at:relativetime',
        ],
    ]); ?>
</div>
