<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;

use common\models\Personajes;
use common\models\Relaciones;
use common\models\RelacionesSearch;
use common\models\Solicitudes;
use yii\web\NotFoundHttpException;

use common\utilities\ArtchiveCBase;

/**
 * RelacionesController implements the CRUD actions for Relaciones model.
 */
class RelacionesController extends ArtchiveCBase
{
    use \common\utilities\Permisos;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    $this->mustBeMyCharacterOnRelas(['delete']),
                    $this->mustBeMyCharacterForCR(['create']),
                    $this->mustBeLoggedForAll(),
                ],
            ],
        ];
    }

    public function init()
    {
        $this->class = new Relaciones();
        $this->search = new RelacionesSearch();
        parent::init();
    }

    public function whatIDo()
    {
        return ['find'];
    }


    /**
     * Creates a new Relaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $id = Yii::$app->request->get('id');
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
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id = '')
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        $pj = $model->personaje_id;
        if ($model->referencia) {
            $solicitud = Solicitudes::findOne(['relacion_id' => $id]);
            if ($solicitud) {
                $solicitud->relacion_id = null;
                $solicitud->save();
            }
        }
        $model->delete();

        if (!Yii::$app->request->isAjax) {
            return $this->redirect(['/personajes/view', 'id' => $pj]);
        }
        return true;
    }
}
