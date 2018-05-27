<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\markdown\Markdown;

/* @var $this yii\web\View */
/* @var $model common\models\Publicaciones */

$owner = $model->getUsuario()->one()->username;

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => $owner, 'url' => ['/usuarios-completo/view', 'username' => $owner]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Publicaciones de') . ' ' . $owner, 'url' => ['index', 'username' => $owner]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicaciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'titulo',
            'created_at:datetime',
            [
                'attribute' => 'contenido',
                'format' => 'html',
                'value' => function ($model) {
                    return Markdown::convert($model->contenido);
                }
            ],
            'updated_at:relativetime',
        ],
    ]) ?>


    <?php $model->getButtons() ?>

    <?= $this->render('_comentarios', [
        'comentarios' => $comentarios,
        'model' => $model,
        'pagination' => $pagination,
    ]) ?>

</div>
