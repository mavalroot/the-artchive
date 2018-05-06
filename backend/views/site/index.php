<?php

/* @var $this yii\web\View */
use yii\grid\GridView;

$this->title = 'My Yii Application';

?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="col-lg-6">
                <h2>
                    Actividad reciente
                    <a href="" class="btn btn-sm btn-info">Ver todo</a>
                </h2>

                <?= GridView::widget([
                    'dataProvider' => $reciente,
                    'columns' => [
                        'created_by',
                        [
                            'attribute' => 'Mensaje',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return "<a href=\"$model->url\">$model->mensaje</a>";
                            }
                        ],
                        'created_at:relativetime',

                    ],
                ]); ?>
                </div>
            <div class="col-lg-6">
                <h2>
                    Últimos usuarios
                    <a href="usuarios-completo/index" class="btn btn-sm btn-info">Ver todo</a>
                </h2>

                <?= GridView::widget([
                    'dataProvider' => $usuarios,
                    'columns' => [
                        [
                            'attribute' => 'username',
                            'format' => 'raw',
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
        <div class="row">
            <div class="col-lg-6">
                <h2>
                    Últimos pjs
                    <a href="personajes/index" class="btn btn-sm btn-info">Ver todo</a>
                </h2>

                <?= GridView::widget([
                    'dataProvider' => $personajes,
                    'columns' => [
                        [
                            'attribute' => 'creator',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->GetUrlCreator();
                            }
                        ],
                        [
                            'attribute' => 'nombre',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->getUrl();
                            }
                        ],
                    ],
                ]); ?>
            </div>
            <div class="col-lg-6">
                <h2>
                    Últimas publicaciones
                    <a href="publicaciones/index" class="btn btn-sm btn-info">Ver todo</a>
                </h2>

                <?= GridView::widget([
                    'dataProvider' => $publicaciones,
                    'columns' => [
                        [
                            'attribute' => 'creator',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->GetUrlCreator();
                            }
                        ],
                        [
                            'attribute' => 'titulo',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->getUrl();
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
        <div class="row">
            <h2>Otras gestiones:</h2>
            <a href="">Gestionar baneos</a>
        </div>
    </div>
</div>
