<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\MensajesPrivados;
use common\models\MensajesPrivadosSearch;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * MensajesPrivadosController implements the CRUD actions for MensajesPrivados model.
 */
class MensajesPrivadosController extends Controller
{
    use \common\utilities\Permisos;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => $this->paramByPost(['delete']),
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    $this->mustBeLoggedForAll(),
                    $this->mustBeMyMessage(['view', 'delete']),
                ],
            ],
        ];
    }

    /**
     * Lists all MensajesPrivados models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MensajesPrivadosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['receptor_id' => Yii::$app->user->id, 'del_r' => false]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all MensajesPrivados models.
     * @return mixed
     */
    public function actionSent()
    {
        $searchModel = new MensajesPrivadosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['emisor_id' => Yii::$app->user->id, 'del_e' => false]);

        return $this->render('sent', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MensajesPrivados model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $mensaje = $this->findModel($id);

        if (($mensaje->imEmisor() && $mensaje->del_e) || ($mensaje->imReceptor() && $mensaje->del_r)) {
            return $this->redirect(['index']);
        }
        return $this->render('view', [
            'model' => $mensaje,
        ]);
    }

    /**
     * Creates a new MensajesPrivados model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MensajesPrivados();
        $model->emisor_id = Yii::$app->user->id;

        $receptor = User::findOne(['username' => Yii::$app->request->post('MensajesPrivados')['emisor_name']]);

        if ($receptor) {
            $model->receptor_id = $receptor->id;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MensajesPrivados model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $mensaje = $this->findModel($id);

        if ($mensaje->imEmisor()) {
            $mensaje->del_e = true;
            $mensaje->save();
        }
        if ($mensaje->imReceptor()) {
            $mensaje->del_r = true;
            $mensaje->save();
        }
        if ($mensaje->del_r && $mensaje->del_e) {
            $mensaje->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the MensajesPrivados model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return MensajesPrivados the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MensajesPrivados::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
