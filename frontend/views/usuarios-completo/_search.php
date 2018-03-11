<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompletoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-completo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'aficiones') ?>

    <?= $form->field($model, 'tematica_favorita') ?>

    <?= $form->field($model, 'plataforma') ?>

    <?php // echo $form->field($model, 'pagina_web')?>

    <?php // echo $form->field($model, 'avatar')?>

    <?php // echo $form->field($model, 'tipo_usuario')?>

    <?php // echo $form->field($model, 'created_at')?>

    <?php // echo $form->field($model, 'updated_at')?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
