<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Delete Account';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-delete-account">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Mensaje</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
