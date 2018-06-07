<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;

use common\models\ActividadRecienteSearch;
use yii\web\Controller;

/**
 * ActividadRecienteController implements the CRUD actions for ActividadReciente model.
 */
class ActividadRecienteController extends Controller
{
    use \common\utilities\Permisos;
    use \common\utilities\CommonActions;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    $this->mustBeAdmin(['index']),
                ],
            ],
            'verbs' => $this->paramByPost(['delete']),
        ];
    }

    /**
     * Lists all ActividadReciente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActividadRecienteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['created_at' => SORT_DESC]
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
