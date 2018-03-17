<?php

namespace frontend\controllers;

use Yii;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

use common\models\User;
use common\models\UsuariosDatos;
use frontend\models\DeleteAccountForm;

class DeleteAccountController extends Controller
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
                    'baja' => ['post'],
                ],
            ],
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
     * Abre la ventana para gestionar la baja del usuario, y desde ahí la gestiona.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new DeleteAccountForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = $this->findModel($model->username);
            $this->actionDesactivarUsuario($user);

            Yii::$app->getSession()->setFlash('success', 'Se ha dado de baja satisfactoriamente.');
            return $this->goHome();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Da de baja el usuario. Se procede a cambiar el nombre de usuario,
     * su correo, y su estado.
     * @param User $user
     * @return bool Devuelve si se ha logrado satisfactoriamente en forma de booleano.
     */
    public function actionDesactivarUsuario($user)
    {
        // $user->username = '--' . $user->id . '--';
        // $user->email = Yii::$app->security->generateRandomString();
        // $user->status = 0;
        // if ($user->save()) {
        //     return true;
        // }
        // return false;
    }

    /**
     * Borra los datos asociados a un usuario de la tabla usuarios_datos.
     * @param  User $user
     */
    public function actionBorrarDatos($user)
    {
        $datos = UsuariosDatos::findOne($user->id);
        // $datos->delete();
    }

    /**
     * Borra los personajes del usuario si al darse de baja así lo especificó.
     * @param  User $user
     */
    public function actionBorrarPjs($user)
    {
    }

    /**
     * Borra las publicaciones del usuario si al darse de baja así lo especificó.
     * @param  User $user
     */
    public function actionBorrarPublicaciones($user)
    {
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $username
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($username)
    {
        if (($model = User::findOne(['username' => $username])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
