<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;

use common\models\ActividadReciente;
use common\models\ActividadRecienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActividadRecienteController implements the CRUD actions for ActividadReciente model.
 */
class ActividadRecienteController extends Controller
{
    use \common\utilities\Permisos;

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

    /**
     * Finds the ActividadReciente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActividadReciente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActividadReciente::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'La página requerida no existe.'));
    }
}
