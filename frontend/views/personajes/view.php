<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Personajes */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Personajes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personajes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'fecha_nac',
            'historia:ntext',
            'personalidad:ntext',
            'apariencia:ntext',
            'hechos_destacables:ntext',
            'created_at:datetime',
            'updated_at:relativeTime',
        ],
    ]) ?>

    <?= $model->getUpdateButton() ?>

</div>
