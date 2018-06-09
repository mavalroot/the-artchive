<?php

/* @var $this yii\web\View */
/* @var $model common\models\MensajesPrivados */

$this->title = $model->asunto;
$this->params['breadcrumbs'][] = ['label' => 'Inbox', 'url' => ['index']];
if ($model->emisor_id == Yii::$app->user->id) {
    $this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Mensajes enviados'), 'url' => ['sent']];
}
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->user->identity->setSeen($model, 'receptor_id');
?>
<div class="mensajes-privados-view">

    <?= $this->render('_view', [
        'model' => $model,
    ]) ?>

</div>
