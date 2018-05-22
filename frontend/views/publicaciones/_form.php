<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\markdown\MarkdownEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Publicaciones */
/* @var $form yii\widgets\ActiveForm */

$custom = [

];

?>

<div class="estandar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <label>Contenido</label>
    <?= MarkdownEditor::widget([
        'model' => $model,
        'attribute' => 'contenido',
        'height' => 200,
        'showExport' => false,
        'footerMessage' => false,
    ]);?>

    <div class="form-group text-center">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
