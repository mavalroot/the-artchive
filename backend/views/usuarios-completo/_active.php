<?php
use yii\grid\GridView;

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\TiposUsuario;

?>

<div id="botones">
    <p>
        <h4>Moderar</h4>
        <?= Html::a('Modificar datos de registro', ['user/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Modificar datos personales', ['usuarios-datos/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
                'confirm' => '¿Seguro que quieres expulsar a este usuario? La acción no podrá revertirse.',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <p>
        <h4>Permisos</h4>
        <?php if ($model->tipo != TiposUsuario::MOD) : ?>
            <?= Html::a('Hacer moderador', ['mod', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => '¿Estás seguro? Si confirmas este usuario se convertirá en moderador.',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?php if ($model->tipo != TiposUsuario::ADMIN) : ?>
            <?= Html::a('Hacer admin', ['admin', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Estás seguro? Si confirmas este usuario se convertirá en administrador.',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?php if ($model->tipo != TiposUsuario::NORMAL) : ?>
            <?= Html::a('Degradar', ['downgrade', 'id' => $model->id], [
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
        'username',
        'id',
        'status',
        'tipo',
        'email:email',
        'seguidores',
        'siguiendo',
        'aficiones',
        'tematica_favorita',
        'bio',
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
