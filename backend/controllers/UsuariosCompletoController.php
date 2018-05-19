<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;

use common\models\User;
use common\models\TiposUsuario;
use common\models\UsuariosCompleto;
use common\models\UsuariosCompletoSearch;
use common\models\ActividadRecienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use frontend\models\DeleteAccountForm;

/**
 * UsuariosCompletoController implements the CRUD actions for UsuariosCompleto model.
 */
class UsuariosCompletoController extends Controller
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
                    $this->mustBeAdmin([
                        'index',
                        'view',
                        'kickout',
                        'mod',
                        'admin',
                        'downgrade'
                    ]),
                ],
            ],
            'verbs' => $this->paramByPost(['kickout']),
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
        $model = $this->findModel($username);
        $reciente = new ActividadRecienteSearch();

        $reciente = $reciente->search(Yii::$app->request->queryParams);
        $reciente->query->where(['created_by' => $model->id]);

        return $this->render('view', [
            'model' => $model,
            'reciente' => $reciente,
        ]);
    }

    public function actionKickout($id)
    {
        $model = UsuariosCompleto::findOne(['id' => $id]);
        $delete = new DeleteAccountForm();

        $delete->username = $model->username;
        $delete->personajes = true;
        $delete->publicaciones = true;

        $delete->borrarTodo();
        if ($delete->desactivarUsuario()) {
            Yii::$app->getSession()->setFlash('success', 'Se ha dado de baja satisfactoriamente.');
        } else {
            Yii::$app->getSession()->setFlash('error', 'No se pudo dar de baja.');
        }
        return $this->redirect(['view', 'username' => $delete->username]);
    }

    public function actionMod($id)
    {
        $usuario = User::findOne($id);
        $usuario->setTipo(TiposUsuario::MOD);
        return $this->redirect(['view', 'username' => $usuario->username]);
    }

    public function actionAdmin($id)
    {
        $usuario = User::findOne($id);
        $usuario->setTipo(TiposUsuario::ADMIN);
        return $this->redirect(['view', 'username' => $usuario->username]);
    }

    public function actionDowngrade($id)
    {
        $usuario = User::findOne($id);
        $usuario->setTipo(TiposUsuario::NORMAL);
        return $this->redirect(['view', 'username' => $usuario->username]);
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
