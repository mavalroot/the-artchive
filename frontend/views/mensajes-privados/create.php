<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MensajesPrivados */

$this->title = Yii::t('frontend', 'Mandar mensaje privado');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Mensajes Privados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estandar-action">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
