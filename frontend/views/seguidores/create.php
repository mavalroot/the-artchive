<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Seguidores */

$this->title = 'Create Seguidores';
$this->params['breadcrumbs'][] = ['label' => 'Seguidores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seguidores-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
