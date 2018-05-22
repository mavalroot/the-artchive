<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\markdown\Markdown;

/* @var $this yii\web\View */
/* @var $model common\models\Personajes */

$owner = $model->getUsuario()->one()->username;

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => $owner, 'url' => ['/usuarios-completo/view', 'username' => $owner]];
$this->params['breadcrumbs'][] = ['label' => 'Personajes de ' . $owner, 'url' => ['index', 'username' => $owner]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personajes-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="btn-group">
        <?= $model->getButtons() ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'fecha_nac:date',
            [
                'attribute' => 'historia',
                'format' => 'html',
                'value' => function ($model) {
                    return Markdown::convert($model->historia);
                }
            ],
            [
                'attribute' => 'personalidad',
                'format' => 'html',
                'value' => function ($model) {
                    return Markdown::convert($model->personalidad);
                }
            ],
            [
                'attribute' => 'apariencia',
                'format' => 'html',
                'value' => function ($model) {
                    return Markdown::convert($model->apariencia);
                }
            ],
            [
                'attribute' => 'hechos_destacables',
                'format' => 'html',
                'value' => function ($model) {
                    return Markdown::convert($model->hechos_destacables);
                }
            ],
            'created_at:date',
            'updated_at:relativeTime',
        ],
    ]) ?>

    <?= $model->getExportButton() ?>
</div>
