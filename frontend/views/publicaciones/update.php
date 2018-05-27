<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Publicaciones */

$owner = $model->getUsuario()->one()->username;

$this->title = Yii::t('frontend', 'Modificar publicación:') . ' ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => $owner, 'url' => ['/usuarios-completo/view', 'username' => $owner]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Publicaciones de') . ' ' . $owner, 'url' => ['index', 'username' => $owner]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Modificar');
?>
<div class="estandar-action">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
