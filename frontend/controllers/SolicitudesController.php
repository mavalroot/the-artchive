<?php

namespace frontend\controllers;

use Yii;
use common\models\Solicitudes;
use common\models\Relaciones;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SolicitudesController implements the CRUD actions for Solicitudes model.
 */
class SolicitudesController extends Controller
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


    /**
     * Displays a single Solicitudes model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionAceptar($id)
    {
        $model = $this->findModel($id);
        if ($this->respuesta($model, true)) {
            return $this->redirect(['view', 'id' => $id]);
        }
    }

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

    public function respuesta($model, $bool)
    {
        if ($model->isMine() && !$model->respondida) {
            return $model->responder($bool);
        }
        return false;
    }

    /**
     * Finds the Solicitudes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Solicitudes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Solicitudes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'La página requerida no existe.'));
    }
}
