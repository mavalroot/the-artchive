<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReportesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mis reportes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportes-index">

    <h1 class="title-index"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p class="text-right">
        <?= Html::a('<i class="fas fa-exclamation-triangle"></i> ' . Yii::t('app', 'Reportar un problema'), ['create'], ['class' => 'btn btn-link especial especial']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'referencia',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->getUrl();
                }
            ],
            'estado',
            'created_at:relativetime',
        ],
    ]); ?>
</div>
