<?php

/* @var $this yii\web\View */
use yii\grid\GridView;

$this->title = 'My Yii Application';

?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="col-lg-6">
                <h2>Actividad reciente</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
                </div>
            <div class="col-lg-6">
                <h2>Últimos usuarios</h2>

                <?= GridView::widget([
                    'dataProvider' => $usuarios,
                    'columns' => [
                        [
                            'attribute' => 'username',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->getUser()->getUrl();
                            }
                        ],
                        'email:email'
                    ],
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h2>Últimos pjs</h2>

                <?= GridView::widget([
                    'dataProvider' => $personajes,
                    'columns' => [
                        [
                            'attribute' => 'creator',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->getCreator();
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
                <h2>Últimas publicaciones</h2>

                <?= GridView::widget([
                    'dataProvider' => $publicaciones,
                    'columns' => [
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

        </div>
</div>
