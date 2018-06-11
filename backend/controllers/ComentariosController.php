<?php

namespace backend\controllers;

use Yii;
use common\models\Comentarios;
use common\models\ComentariosSearch;
use common\utilities\ArtchiveCBase;
use yii\filters\VerbFilter;

/**
 * ComentariosController implements the CRUD actions for Comentarios model.
 */
class ComentariosController extends ArtchiveCBase
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Comentarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComentariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function init()
    {
        $this->class = new Comentarios();
        $this->search = new ComentariosSearch();
        parent::init();
    }

    public function whatIDo()
    {
        return ['index', 'view', 'update', 'delete', 'find'];
    }
}
