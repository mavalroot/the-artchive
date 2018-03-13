<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MensajesPrivados */

$this->title = $model->asunto;
$this->params['breadcrumbs'][] = ['label' => 'Inbox', 'url' => ['index']];
if ($model->emisor_id == Yii::$app->user->id) {
    $this->params['breadcrumbs'][] = ['label' => 'Mensajes enviados', 'url' => ['sent']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensajes-privados-view">

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
            // 'id',
            // 'emisor_id',
            // 'receptor_id',
            'asunto',
            'contenido:ntext',
            // 'visto:boolean',
            // 'leido:boolean',
            'created_at:datetime',
        ],
    ]) ?>

</div>
