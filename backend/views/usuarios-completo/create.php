<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompleto */

$this->title = 'Create Usuarios Completo';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios Completos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-completo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
