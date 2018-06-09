<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;

use common\models\Notificaciones;
use common\models\NotificacionesSearch;

use common\utilities\ArtchiveCBase;

/**
 * NotificacionesController implements the CRUD actions for Notificaciones model.
 */
class NotificacionesController extends ArtchiveCBase
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

    public function init()
    {
        $this->class = new Notificaciones();
        $this->search = new NotificacionesSearch();
        parent::init();
    }

    public function whatIDo()
    {
        return ['find'];
    }

    /**
     * Lists all Notificaciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->commonIndex([
            'search' => $this->search,
            'where' => ['usuario_id' => Yii::$app->user->id],
            'order' => 'created_at DESC',
        ]);
    }
}
