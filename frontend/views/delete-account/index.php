<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\DeleteAccountForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('frontend', 'Darse de baja');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estandar-action">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="estandar-form">

    <p>
        <?= Yii::t('frontend/long', 'Recuerda que eliminar tu cuenta significa la desaparición de todos tus datos, así como de tus publicaciones y personajes en caso de que así lo desees. En ningún caso se borrarán los comentarios que hiciste en otras publicaciones, pero tranquilo, tu nombre de usuario no se verá implicado.') ?>
    <br />
    <b><?= Yii::t('frontend/long', 'Esta acción no podrá ser revertida, pero podrás volver a registrarte en un futuro con el mismo nombre.') ?></b></p>

            <?php $form = ActiveForm::begin(['action' =>['delete-account/delete']]); ?>
                <p>
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                </p>
                <p>
                    <?= Yii::t('frontend/long', 'Puedes elegir borrar completamente tus personajes y publicaciones, o dejarlas en The Artchive (tu nombre de usuario no se verá implicado.') ?>
                </p>
                <p>
                    <?= $form->field($model, 'personajes')->checkbox(['label' => Yii::t('frontend', 'Eliminar personajes')]) ?>
                    <?= $form->field($model, 'publicaciones')->checkbox(['label' => Yii::t('frontend', 'Eliminar publicaciones')]) ?>
                </p>

                <div class="form-group text-center">
                    <?= Html::submitButton(Yii::t('frontend', 'Darme de baja'), ['class' => 'btn btn-danger']) ?>
                </div>

            <?php ActiveForm::end(); ?>
</div>
</div>
