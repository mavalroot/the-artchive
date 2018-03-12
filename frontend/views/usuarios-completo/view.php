<?php

use yii\data\ActiveDataProvider;

use yii\grid\GridView;

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\Personajes;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompleto */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-completo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            [
                'attribute' => 'email',
                'value' => function ($model) {
                    return $model->isSelf() ? $model->email : '---';
                }
            ],
            'aficiones',
            'tematica_favorita',
            'plataforma',
            'pagina_web',
            'avatar',
            'tipo_usuario',
            'created_at:datetime',
            'updated_at:relativeTime',
        ],
    ]) ?>

    <?= $model->getUpdateButton() ?>

    <h2>Personajes recientes</h2>
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query' => $model->getPersonajes()->orderBy(['updated_at' => SORT_DESC])->limit(3),
            'sort'=> false,
            'pagination' => false,
        ]),
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

    <?= Html::a('Ver personajes', ['personajes', 'username' => $model->username], ['class' => 'btn btn-success']);
    /* Html::a('Ver personajes', ['personajes/index', 'id' => $model->getUser()->id], ['class' => 'btn btn-success'])*/ ?>

</div>
