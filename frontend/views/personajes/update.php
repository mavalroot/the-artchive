<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Personajes */


$owner = $model->getUsuario()->one()->username;

$this->title = Yii::t('frontend', 'Modificar personaje:') . ' ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => $owner, 'url' => ['/usuarios-completo/view', 'username' => $owner]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Personajes de') . ' ' . $owner, 'url' => ['index', 'username' => $owner]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Modificar');
?>
<div class="estandar-action">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
