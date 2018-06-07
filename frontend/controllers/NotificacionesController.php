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
        return $this->commonIndex([
            'model' => new NotificacionesSearch(),
            'where' => [
                'usuario_id' => Yii::$app->user->id,
            ],
            'name' => 'index',
            'order' => 'created_at DESC',
        ]);
    }
}
