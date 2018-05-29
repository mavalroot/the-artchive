<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Reportes */

$this->title = $model->referencia;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Responder'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'estado',
            'referencia',
            'contenido:ntext',
            'respuesta',
            'created_by',
            'created_at:datetime',
        ],
    ]) ?>

</div>
