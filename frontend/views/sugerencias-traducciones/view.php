<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SugerenciasTraducciones */

$this->title = $model->referencia;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sugerencias Traducciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sugerencias-traducciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'referencia',
            'contenido:ntext',
            'estado',
            'respuesta',
            'created_at:datetime',
        ],
    ]) ?>

</div>
