<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TiposRelaciones */

$this->title = 'Create Tipos Relaciones';
$this->params['breadcrumbs'][] = ['label' => 'Tipos Relaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-relaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
