<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Solicitudes */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Solicitudes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitudes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= $model->mensaje ?>
    </p>
    <?php if ($model->respondida): ?>
        <b>
        <?php if ($model->aceptada): ?>
            Aceptaste
        <?php else: ?>
            Rechazaste
        <?php endif; ?>
        esta solicitud.
        </b>
    <?php endif; ?>
    <p>
        <?= $model->getButtons() ?>
    </p>

</div>
