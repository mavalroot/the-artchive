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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email:email',
            'aficiones',
            'tematica_favorita',
            'plataforma',
            //'pagina_web',
            //'avatar',
            //'tipo_usuario',
            //'created_at',
            //'updated_at',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
