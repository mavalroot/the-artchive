<?php

namespace frontend\controllers;

use Yii;
use common\models\Seguidores;
use common\models\SeguidoresSearch;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SeguidoresController implements the CRUD actions for Seguidores model.
 */
class SeguidoresController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Seguidores models.
     * @return mixed
     */
    public function actionIndex($username)
    {
        $user = User::findOne(['username' => $username]);

        if ($user) {
            $id = $user->id;
        }

        if (isset($id)) {
            $searchModel = new SeguidoresSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->where(['usuario_id' => $id]);


            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFollowing($username)
    {
        $user = User::findOne(['username' => $username]);

        if ($user) {
            $id = $user->id;
        }

        if (isset($id)) {
            $searchModel = new SeguidoresSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->where(['seguidor_id' => $id]);


            return $this->render('following', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Displays a single Seguidores model.
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

    /**
     * Creates a new Seguidores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Seguidores();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Seguidores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Seguidores model.
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
     * Finds the Seguidores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Seguidores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Seguidores::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
