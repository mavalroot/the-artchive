<?php
use yii\helpers\Html;

use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['action' => ['delete-account/delete'], 'id' => 'delete-form']); ?>
    <p>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    </p>
    <p>
        <?= Yii::t('frontend/long', 'Puedes elegir borrar completamente tus personajes y publicaciones, o dejarlas en The Artchive.') ?>
    </p>
    <p>
        <?= $form->field($model, 'personajes')->checkbox(['label' => Yii::t('frontend', 'Eliminar personajes')]) ?>
        <?= $form->field($model, 'publicaciones')->checkbox(['label' => Yii::t('frontend', 'Eliminar publicaciones')]) ?>
    </p>

    <div class="form-group text-center">
        <?= Html::submitButton(Yii::t('frontend', 'Darme de baja'), ['class' => 'btn btn-danger']) ?>
    </div>

<?php ActiveForm::end(); ?>
