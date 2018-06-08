<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MensajesPrivadosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Bandeja de entrada');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensajes-privados-index">

    <h1 class="title-index"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a(Yii::t('frontend', 'Enviar mensaje privado'), ['create'], ['class' => 'btn btn-link']) ?>
        <?= Html::a(Yii::t('frontend', 'Ver mensajes enviados'), ['sent'], ['class' => 'btn btn-link']) ?>
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
            'created_at:datetime',
            ['class' => 'yii\grid\ActionColumn',  'template'=> ' {delete}'],
        ],
    ]); ?>
</div>
