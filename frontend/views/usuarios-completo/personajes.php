<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\PersonajesSearch;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompleto */

$this->title = 'Personajes de ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'username' => $model->username]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="usuarios-completo-personajes">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $model->getMisPersonajes(),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'nombre',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->nombre, $model->getUrl());
                }
            ],
            'created_at:datetime',
            'updated_at:relativeTime',
        ],
    ]); ?>
</div>
