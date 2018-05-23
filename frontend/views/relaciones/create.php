<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Relaciones */

$this->title = 'Create Relaciones';
$this->params['breadcrumbs'][] = ['label' => 'Relaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
