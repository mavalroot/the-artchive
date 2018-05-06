<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PersonajesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personajes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personajes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'creator',
            'nombre',
            'created_at:date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
