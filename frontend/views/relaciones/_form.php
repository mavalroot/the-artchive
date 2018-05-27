<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\TiposRelaciones;
use common\models\Personajes;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Relaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estandar-form">
    <p>
        <?= Yii::t('frontend', 'Relaciones que mantiene tu personaje') ?> <?= $personaje->nombre ?> <?= Yii::t('frontend', 'con otros personajes.') ?>
        <br />
        <?= Yii::t('frontend', 'Ten en cuenta que el sentido sería: <b>Personaje</b> es <em>hermano/a</em> de') ?> <b><?= $personaje->nombre ?></b>.
    </p>
    <?php $form = ActiveForm::begin(); ?>

    <?= Html::hiddenInput('Relaciones[personaje_id]', $personaje->id) ?>

        <?= $form->field($model, 'tipo_relacion_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(TiposRelaciones::find()->all(), 'id', 'tipo'),
            'options' => ['placeholder' => Yii::t('frontend', 'Buscar al escribir...')],
        ]); ?>
    <div class="col-sm-6">
        <?= $form->field($model, 'referencia')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Personajes::find()->all(), 'id', 'nombre'),
            'options' => ['placeholder' => Yii::t('frontend', 'Buscar al escribir...')],
        ]); ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'nombre')->textInput(); ?>
    </div>

    <p>
        <?= Yii::t('frontend/long', 'El personaje con el que el nuestro se relaciona puede ser anónimo (sólo figurará su nombre) o existente (propio o de otro usuario). <br />
        Si seleccionas un personaje existente que no sea de tu propiedad, su creador deberá dar el visto bueno.') ?>
    </p>

    <div class="form-group text-center">
        <?= Html::submitButton(Yii::t('frontend', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
