<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UsuariosCompletoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios Completos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-completo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Usuarios Completo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            'aficiones',
            'tematica_favorita',
            //'plataforma',
            //'pagina_web',
            //'avatar',
            //'tipo',
            //'seguidores',
            //'siguiendo',
            //'created_at',
            //'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
