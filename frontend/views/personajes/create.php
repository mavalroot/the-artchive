<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Personajes */

$this->title = 'Crear personaje';
// $this->params['breadcrumbs'][] = ['label' => 'Personajes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estandar-action">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
