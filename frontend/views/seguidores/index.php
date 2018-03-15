<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SeguidoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Seguidores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seguidores-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Seguidores', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'seguidor_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
