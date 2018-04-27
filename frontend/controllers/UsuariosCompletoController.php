<?php

namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\Seguidores;
use common\models\UsuariosCompleto;
use common\models\UsuariosCompletoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UsuariosCompletoController implements the CRUD actions for UsuariosCompleto model.
 */
class UsuariosCompletoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all UsuariosCompleto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosCompletoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsuariosCompleto model.
     * @param string $username
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($username)
    {
        return $this->render('view', [
            'model' => $this->findModel($username),
        ]);
    }

    /**
     * Comienza a seguir a un usuario.
     * @return bool         True si no ha habido ningún error, falso si sí.
     */
    public function actionSeguir()
    {
        $id = Yii::$app->request->post('id');
        if (isset($id)) {
            $seguir = new Seguidores();
            $seguir->user_id = $id;
            $seguir->seguidor_id = Yii::$app->user->id;

            return $seguir->validate() && $seguir->save();
        }
    }

    /**
     * Finds the UsuariosCompleto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return UsuariosCompleto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsuariosCompleto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
