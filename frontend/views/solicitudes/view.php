<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Solicitudes */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Solicitudes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitudes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= $model->mensaje ?>
    </p>
    <?php if ($model->respondida) : ?>
        <b>
            <?= ($model->aceptada ? Yii::t('frontend', 'Aceptaste') : Yii::t('frontend', 'Rechazaste')) ?>
            <?= Yii::t('frontend', 'esta solicitud.') ?>
        </b>
    <?php endif; ?>
    <p>
        <?= $model->getButtons() ?>
    </p>

</div>
