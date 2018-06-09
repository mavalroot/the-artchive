<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\User;
use common\models\TiposUsuario;
use common\models\UsuariosCompleto;
use common\models\UsuariosCompletoSearch;
use common\models\ActividadRecienteSearch;
use yii\web\NotFoundHttpException;
use common\utilities\ArtchiveCBase;
use frontend\models\DeleteAccountForm;

/**
 * UsuariosCompletoController implements the CRUD actions for UsuariosCompleto model.
 */
class UsuariosCompletoController extends ArtchiveCBase
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

    public function init()
    {
        $this->class = new UsuariosCompleto();
        $this->search = new UsuariosCompletoSearch();
        parent::init();
    }

    public function whatIDo()
    {
        return ['index', 'find'];
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

    /**
     * Elimina un usuario.
     * @param  int $id id del usuario
     * @return mixed
     */
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

    /**
     * Da permisos de moderador al usuario.
     * @param  int $id
     * @return mixed
     */
    public function actionMod($id)
    {
        $usuario = User::findOne($id);
        $usuario->setTipo(TiposUsuario::MOD);
        return $this->redirect(['view', 'username' => $usuario->username]);
    }

    /**
     * Da permisos de admin al usuario.
     * @param  int $id
     * @return mixed
     */
    public function actionAdmin($id)
    {
        $usuario = User::findOne($id);
        $usuario->setTipo(TiposUsuario::ADMIN);
        return $this->redirect(['view', 'username' => $usuario->username]);
    }

    /**
     * Quita los permisos al usuario.
     * @param  int $id
     * @return mixed
     */
    public function actionDowngrade($id)
    {
        $usuario = User::findOne($id);
        $usuario->setTipo(TiposUsuario::NORMAL);
        return $this->redirect(['view', 'username' => $usuario->username]);
    }
}
