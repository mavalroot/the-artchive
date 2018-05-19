<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
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
    use \common\utilities\Permisos;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    $this->mustBeLoggedForAll(),
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
