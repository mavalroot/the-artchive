<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Relaciones */

$this->title = Yii::t('frontend', 'Añadir relación a') . ' ' . $personaje->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Relaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estandar-action">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'personaje' => $personaje,
    ]) ?>

</div>
