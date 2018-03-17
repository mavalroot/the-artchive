<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

use yii\widgets\ActiveForm;

$this->title = 'Delete Account';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-delete-account">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Mensaje de advertencia.</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(); ?>
                <p>
                    <?= Html::label('Username', 'username');  ?>
                    <?= Html::textInput('delete[username]') ?>
                </p>
                <p>Mensaje informativo.</p>
                <p>
                    <?= Html::checkbox('delete[personajes]', true, ['label' => 'Eliminar personajes']) ?>
                    <?= Html::checkbox('delete[publicaciones]', true, ['label' => 'Eliminar publicaciones']) ?>
                </p>

                <div class="form-group">
                    <?= Html::submitButton('Delete Account', ['class' => 'btn btn-danger']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
