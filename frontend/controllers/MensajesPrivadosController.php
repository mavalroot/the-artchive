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
    use \common\traitrollers\CommonIndex;
    use \common\traitrollers\CommonFindModel;
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
                    $this->mustBeMyMessage(['view', 'delete']),
                    $this->mustBeLoggedForAll(),
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
        return $this->commonIndex([
            'model' => new MensajesPrivadosSearch(),
            'where' => [
                'receptor_id' => Yii::$app->user->id,
                'del_r' => false],
            'name' => 'index'
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
        $mensaje = $this->findModel($id, new MensajesPrivados());

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

        if (Yii::$app->request->get('username')) {
            $nombre = Yii::$app->request->get('username');
            $receptor = User::findOne(['username' => $nombre])->id;
            $model->receptor_id = $receptor;
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
        $mensaje = $this->findModel($id, new MensajesPrivados());

        if ($mensaje->imEmisor()) {
            $mensaje->del_e = true;
            $mensaje->save();
        }
        if ($mensaje->imReceptor()) {
            $mensaje->del_r = true;
            $mensaje->seen = true;
            $mensaje->save();
        }
        if ($mensaje->del_r && $mensaje->del_e) {
            $mensaje->delete();
        }

        return $this->redirect(['index']);
    }
}
