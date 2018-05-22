<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;

use common\models\Notificaciones;
use common\models\NotificacionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * NotificacionesController implements the CRUD actions for Notificaciones model.
 */
class NotificacionesController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Lists all Notificaciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotificacionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->where(['usuario_id' => Yii::$app->user->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing Notificaciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notificaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Notificaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notificaciones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
