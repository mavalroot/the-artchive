<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Publicaciones */

$this->title = 'Crear publicación';
// $this->params['breadcrumbs'][] = ['label' => 'Publicaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
