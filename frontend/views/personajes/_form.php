<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\markdown\MarkdownEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Personajes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estandar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <div class="form-group">

        <?= $form->field($model, 'fecha_nac')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Elija fecha de nacimiento...'],
            'pluginOptions' => [
                'autoclose'=> true,
                'format' => 'yyyy-mm-dd',
            ]
        ]); ?>
    </div>

    <label><?= Yii::t('frontend', 'Historia') ?></label>
    <?= MarkdownEditor::widget([
        'model' => $model,
        'attribute' => 'historia',
        'height' => 200,
        'showExport' => false,
        'footerMessage' => false,
    ]);?>

    <label><?= Yii::t('frontend', 'Personalidad') ?></label>
    <?= MarkdownEditor::widget([
        'model' => $model,
        'attribute' => 'personalidad',
        'height' => 200,
        'showExport' => false,
        'footerMessage' => false,
    ]);?>

    <label><?= Yii::t('frontend', 'Apariencia') ?></label>
    <?= MarkdownEditor::widget([
        'model' => $model,
        'attribute' => 'apariencia',
        'height' => 200,
        'showExport' => false,
        'footerMessage' => false,
    ]);?>

    <label><?= Yii::t('frontend', 'Hechos destacables') ?></label>
    <?= MarkdownEditor::widget([
        'model' => $model,
        'attribute' => 'hechos_destacables',
        'height' => 200,
        'showExport' => false,
        'footerMessage' => false,
    ]);?>

    <div class="form-group text-center">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
