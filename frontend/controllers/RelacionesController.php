<?php

namespace frontend\controllers;

use Yii;
use common\models\Personajes;
use common\models\Relaciones;
use common\models\RelacionesSearch;
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
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->referencia) {
                $model->nombre = null;
            }
            if ($model->save()) {
                $model->enviarSolicitud();
                return $this->redirect(['personajes/view', 'id' => $id]);
            }
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
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}