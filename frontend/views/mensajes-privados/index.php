<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\MensajesPrivados;

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
        <?= Html::a('Ver mensajes enviados', ['sent'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'emisor_name',
            [
                'attribute' => 'asunto',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->getUrl($model->asunto);
                }
            ],
            // 'contenido:ntext',
            //'visto:boolean',
            //'seen:boolean',
            'created_at:datetime',
            ['class' => 'yii\grid\ActionColumn',  'template'=> ' {delete}'],
        ],
    ]); ?>
</div>
