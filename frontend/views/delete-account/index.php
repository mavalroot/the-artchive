<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\DeleteAccountForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Delete Account';
$this->params['breadcrumbs'][] = $this->title;

var_dump($model->getUser());
?>
<div class="site-delete-account">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Mensaje de advertencia.</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['action' =>['delete-account/delete']]); ?>
                <p>
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                </p>
                <p>Mensaje informativo.</p>
                <p>
                    <?= $form->field($model, 'personajes')->checkbox(['label' => 'Eliminar personajes']) ?>
                    <?= $form->field($model, 'publicaciones')->checkbox(['label' => 'Eliminar publicaciones']) ?>
                </p>

                <div class="form-group">
                    <?= Html::submitButton('Delete Account', ['class' => 'btn btn-danger']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
