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
    use \common\traitrollers\CommonIndex;
    use \common\traitrollers\CommonDelete;


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
        $model = new NotificacionesSearch();
        return $this->commonIndex($model, ['usuario_id' => Yii::$app->user->id], 'index');
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
