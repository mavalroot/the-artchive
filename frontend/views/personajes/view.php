<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Personajes */

$owner = $model->getUsuario()->one()->username;

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => $owner, 'url' => ['/usuarios-completo/view', 'username' => $owner]];
$this->params['breadcrumbs'][] = ['label' => 'Personajes de ' . $owner, 'url' => ['/usuarios-completo/personajes', 'username' => $owner]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personajes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'fecha_nac',
            'historia:ntext',
            'personalidad:ntext',
            'apariencia:ntext',
            'hechos_destacables:ntext',
            'created_at:datetime',
            'updated_at:relativeTime',
        ],
    ]) ?>

    <?php $model->getButtons() ?>

</div>
