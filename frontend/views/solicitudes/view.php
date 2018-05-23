<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Solicitudes */

$this->title = $model->getNotificacionContenido();
$this->params['breadcrumbs'][] = ['label' => 'Solicitudes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitudes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= $model->mensaje ?>
    </p>

</div>
