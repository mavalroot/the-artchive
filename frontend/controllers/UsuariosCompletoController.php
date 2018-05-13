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
use common\models\Bloqueos;

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
    public function actionFollow()
    {
        $id = Yii::$app->request->post('id');
        if (isset($id)) {
            $seguir = new Seguidores([
                'usuario_id' => $id,
                'seguidor_id' => Yii::$app->user->id,
            ]);

            return $seguir->validate() && $seguir->save();
        }
    }

    public function actionUnfollow()
    {
        $id = Yii::$app->request->post('id');
        if (isset($id)) {
            $seguir = Seguidores::findOne([
                'usuario_id' => $id,
                'seguidor_id' => Yii::$app->user->id
            ]);
            return $seguir->delete();
        }
    }

    public function actionBlock()
    {
        $id = Yii::$app->request->post('id');
        if (isset($id)) {
            $block = new Bloqueos([
                'usuario_id' => Yii::$app->user->id,
                'bloqueado_id' => $id
            ]);

            return $block->validate() && $block->save();
        }
    }

    public function actionUnblock()
    {
        $id = Yii::$app->request->post('id');
        if (isset($id)) {
            $seguir = Bloqueos::findOne([
                'usuario_id' => Yii::$app->user->id,
                'bloqueado_id' => $id
            ]);
            return $seguir->delete();
        }
    }

    /**
     * Finds the UsuariosCompleto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $username
     * @return UsuariosCompleto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($username)
    {
        if (($model = UsuariosCompleto::findOne(['username' => $username])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
