<?php

/* @var $this yii\web\View */
use yii\grid\GridView;

use yii\helpers\Html;

$this->title = 'My Yii Application';

?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="col-lg-6">
                <h2>
                    Actividad reciente
                    <a href="actividad-reciente/index" class="btn btn-sm btn-info">Ver todo</a>
                </h2>
                    <div class="table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $reciente,
                            'columns' => [
                                [
                                    'attribute' => 'creator',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        return $model->getUrlCreator();
                                    }
                                ],
                                [
                                    'attribute' => 'mensaje',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        if (isset($model->referencia, $model->tipo)) {
                                            return Html::a($model->mensaje, ["{$model->tipo}/view", 'id' => $model->referencia]);
                                        }
                                        return $model->mensaje;
                                    }
                                ],
                                'created_at:relativetime',

                            ],
                        ]); ?>
                    </div>
                </div>
            <div class="col-lg-6">
                <h2>
                    Últimos usuarios
                    <a href="usuarios-completo/index" class="btn btn-sm btn-info">Ver todo</a>
                </h2>
                <div class="table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => $usuarios,
                        'columns' => [
                            [
                                'attribute' => 'username',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->getUrl();
                                }
                            ],
                            'email:email',
                            'status'
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h2>
                    Últimos pjs
                    <a href="personajes/index" class="btn btn-sm btn-info">Ver todo</a>
                </h2>
                <div class="table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => $personajes,
                        'columns' => [
                            [
                                'attribute' => 'creator',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->getUrlCreator();
                                }
                            ],
                            [
                                'attribute' => 'nombre',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->getUrl();
                                }
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
            <div class="col-lg-6">
                <h2>
                    Últimas publicaciones
                    <a href="publicaciones/index" class="btn btn-sm btn-info">Ver todo</a>
                </h2>
                <div class="table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => $publicaciones,
                        'columns' => [
                            [
                                'attribute' => 'creator',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->getUrlCreator();
                                }
                            ],
                            [
                                'attribute' => 'titulo',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->getUrl();
                                }
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <h2>Otras gestiones:</h2>
            <ul>
                <li>
                    <a href="reportes/index">Reportes</a>
                </li>
            </ul>
        </div>
    </div>
</div>
