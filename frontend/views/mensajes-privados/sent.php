<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MensajesPrivadosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Mensajes enviados');
$this->params['breadcrumbs'][] = ['label' => 'Inbox', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensajes-privados-index">

    <h1 class="title-index"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a(Yii::t('frontend', 'Enviar mensaje privado'), ['create'], ['class' => 'btn btn-link especial especial']) ?>
        <?= Html::a(Yii::t('frontend', 'Volver a la Bandeja de entrada'), ['index'], ['class' => 'btn btn-link especial especial']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            [
                'attribute' => 'emisor_name',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a($model->emisor_name, ['/usuarios-completo/view', 'username' => $model->emisor_name]);
                }
            ],
            [
                'attribute' => 'asunto',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->getUrl($model->asunto);
                }
            ],
            'created_at:datetime',
            ['class' => 'yii\grid\ActionColumn', 'template'=> ' {delete}'],
        ],
    ]); ?>
</div>
