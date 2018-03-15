<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MensajesPrivadosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mensajes enviados';
$this->params['breadcrumbs'][] = ['label' => 'Inbox', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensajes-privados-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Enviar mensaje privado', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Volver al Inbox', ['index'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'receptor_name',
            [
                'attribute' => 'asunto',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getUrl($model->asunto);
                }
            ],
            // 'contenido:ntext',
            //'visto:boolean',
            //'leido:boolean',
            'created_at:datetime',
            ['class' => 'yii\grid\ActionColumn', 'template'=> ' {delete}'],
        ],
    ]); ?>
</div>