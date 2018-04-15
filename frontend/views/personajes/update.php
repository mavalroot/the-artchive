<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Personajes */


$owner = $model->getUsuario()->one()->username;

$this->title = 'Modificar personaje: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => $owner, 'url' => ['/usuarios-completo/view', 'username' => $owner]];
$this->params['breadcrumbs'][] = ['label' => 'Personajes de ' . $owner, 'url' => ['index', 'username' => $owner]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="personajes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
