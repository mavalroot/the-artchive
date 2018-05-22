<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Personajes */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Personajes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personajes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'fecha_nac:date',
            'historia:ntext',
            'personalidad:ntext',
            'apariencia:ntext',
            'hechos_destacables:ntext',
            [
                'attribute' => 'creator',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->getCreator()->one()->getUrl();
                }
            ],
            'created_at:datetime',
            'updated_at:relativetime',
        ],
    ]) ?>

</div>
