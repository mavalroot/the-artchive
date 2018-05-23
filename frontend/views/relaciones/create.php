<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Relaciones */

$this->title = 'Añadir relación a ' . $personaje->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Relaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estandar-action">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'personaje' => $personaje,
    ]) ?>

</div>
