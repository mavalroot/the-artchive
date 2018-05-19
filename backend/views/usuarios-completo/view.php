<?php

use yii\grid\GridView;

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\TiposUsuario;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompleto */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-completo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div id="botones">
        <p>
            <?= Html::a('Modificar datos de registro', ['user/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Modificar datos personales', ['usuario-datos/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Banear', ['ban', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('Expulsar', ['kickout', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        <p>
            <?php if ($model->tipo != TiposUsuario::MOD): ?>
                <?= Html::a('Hacer moderador', ['mod', 'id' => $model->id], [
                    'class' => 'btn btn-warning',
                    'data' => [
                        'confirm' => '¿Estás seguro? Si confirmas este usuario se convertirá en moderador.',
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif; ?>
            <?php if ($model->tipo != TiposUsuario::ADMIN): ?>
                <?= Html::a('Hacer admin', ['admin', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Estás seguro? Si confirmas este usuario se convertirá en administrador.',
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif; ?>
            <?php if ($model->tipo != TiposUsuario::NORMAL): ?>
                <?= Html::a('Degradar', ['normal', 'id' => $model->id], [
                    'class' => 'btn btn-warning',
                    'data' => [
                        'confirm' => '¿Estás seguro? Si confirmas este usuario será degradado a usuario normal.',
                        'method' => 'post',
                    ],
                    ]) ?>
            <?php endif; ?>
        </p>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'status',
            'username',
            'tipo',
            'email:email',
            'seguidores',
            'siguiendo',
            'aficiones',
            'tematica_favorita',
            'plataforma',
            'pagina_web',
            'avatar',
            'created_at:datetime',
            'updated_at:relativetime',
        ],
    ]) ?>

    <h2>Actividad reciente</h2>
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $reciente,
            'columns' => [
                [
                    'attribute' => 'mensaje',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if ($model->url) {
                            return "<a href=\"$model->url\">$model->mensaje</a>";
                        }
                        return $model->mensaje;
                    }
                ],
                'created_at:relativetime',

            ],
        ]); ?>
    </div>

</div>
