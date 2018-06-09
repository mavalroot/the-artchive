<?php

namespace frontend\controllers;

use common\models\Relaciones;
use common\models\Solicitudes;
use yii\filters\VerbFilter;

use common\utilities\ArtchiveCBase;

/**
 * SolicitudesController implements the CRUD actions for Solicitudes model.
 */
class SolicitudesController extends ArtchiveCBase
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
                    'aceptar' => ['POST'],
                    'rechazar' => ['POST'],
                ],
            ],
        ];
    }

    public function init()
    {
        $this->class = new Solicitudes();
        $this->search = null;
        parent::init();
    }

    public function whatIDo()
    {
        return ['view', 'find'];
    }

    /**
     * Acepta una solicitud.
     * @param  int $id
     * @return mixed
     */
    public function actionAceptar($id)
    {
        $model = $this->findModel($id);
        if ($this->respuesta($model, true)) {
            return $this->redirect(['view', 'id' => $id]);
        }
    }

    /**
     * Rechaza una solicitud.
     * @param  int $id
     * @return mixed
     */
    public function actionRechazar($id)
    {
        $model = $this->findModel($id);
        $relasid = $model->relacion_id;
        if ($this->respuesta($model, false)) {
            $relas = Relaciones::findOne($relasid);
            $relas->delete();
            return $this->redirect(['view', 'id' => $id]);
        }
    }

    /**
     * Cambia la respuesta de la solicitud.
     * @param  Solicitudes $model
     * @param  bool $bool
     * @return bool
     */
    public function respuesta($model, $bool)
    {
        if ($model->isMine() && !$model->respondida) {
            return $model->responder($bool);
        }
        return false;
    }
}
