<?php

namespace frontend\controllers;

use Yii;
use common\models\Personajes;
use common\models\Relaciones;
use common\models\Solicitudes;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RelacionesController implements the CRUD actions for Relaciones model.
 */
class RelacionesController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * Creates a new Relaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Relaciones();

        if (!is_numeric($id) || !$personaje = Personajes::findOne($id)) {
            throw new NotFoundHttpException(Yii::t('app', 'La página requerida no existe.'));
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->enviarSolicitud();
            return $this->redirect(['personajes/view', 'id' => $id]);
        }

        return $this->render('create', [
            'model' => $model,
            'personaje' => $personaje
        ]);
    }

    /**
     * Deletes an existing Relaciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        $pj = $model->personaje_id;
        if ($model->referencia) {
            $solicitud = Solicitudes::findOne(['relacion_id' => $id]);
            $solicitud->relacion_id = null;
            $solicitud->update();
        }
        $model->delete();

        if (!Yii::$app->request->isAjax) {
            return $this->redirect(['/personajes/view', 'id' => $pj]);
        }
        return true;
    }

    /**
     * Finds the Relaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Relaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Relaciones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'La página requerida no existe.'));
    }
}
