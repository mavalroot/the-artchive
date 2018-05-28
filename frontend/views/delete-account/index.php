<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\DeleteAccountForm */

use yii\helpers\Html;

$this->title = Yii::t('frontend', 'Darse de baja');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estandar-action">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="estandar-form">

    <p>
        <?= Yii::t('frontend/long', 'Recuerda que eliminar tu cuenta significa la desaparición de todos tus datos.') ?>
    <br />
    <b><?= Yii::t('frontend/long', 'Esta acción no podrá ser revertida, pero podrás volver a registrarte en un futuro con el mismo nombre.') ?></b></p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
