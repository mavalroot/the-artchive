<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\PublicacionesSearch;
use yii\web\Controller;

/**
 * PublicacionesController implements the CRUD actions for Publicaciones model.
 */
class PublicacionesController extends Controller
{
    use \common\utilities\Permisos;
    use \common\traitrollers\PublicacionesComun;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    $this->mustBeAdmin(['index', 'view', 'update', 'delete']),
                ],
            ],
            'verbs' => $this->paramByPost(['delete']),
        ];
    }

    /**
     * Lists all Publicaciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PublicacionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
