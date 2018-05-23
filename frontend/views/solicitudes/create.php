<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Solicitudes */

$this->title = 'Create Solicitudes';
$this->params['breadcrumbs'][] = ['label' => 'Solicitudes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitudes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
