<?php

namespace frontend\controllers;

use Yii;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

use common\models\User;
use common\models\Personajes;
use common\models\Seguidores;
use common\models\Publicaciones;
use common\models\UsuariosDatos;
use common\models\Notificaciones;
use common\models\MensajesPrivados;
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
            if ($this->actionDesactivarUsuario($user)) {
                $this->actionBorrarOpciones($model->personajes, $model->publicaciones);
                Yii::$app->getSession()->setFlash('success', 'Se ha dado de baja satisfactoriamente.');
            } else {
                Yii::$app->getSession()->setFlash('error', 'No se pudo dar de baja.');
            }
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
        $user->username = '--' . $user->id . '--';
        $user->email = Yii::$app->security->generateRandomString();
        $user->status = 0;
        if ($user->save()) {
            $this->actionBorrarRastro($user);
            return true;
        }
        return false;
    }

    /**
     * Borra los personajes del usuario si al darse de baja así lo especificó.
     * @param  User $user
     */
    public function actionBorrarPjs($user)
    {
        Personajes::deleteAll(['usuario_id' => $user->id]);
    }

    /**
     * Borra las publicaciones del usuario si al darse de baja así lo especificó.
     * @param  User $user
     */
    public function actionBorrarPublicaciones($user)
    {
        Publicaciones::deleteAll(['usuario_id' => $user->id]);
    }

    /**
     * Maneja el borrado de personajes o de publicaciones
     * @param  string $personajes    '0' no borra. '1' borra.
     * @param  string $publicaciones '0' no borra. '1' borra.
     */
    public function actionBorrarOpciones($personajes, $publicaciones)
    {
        if ($personajes === '1') {
            $this->actionBorrarPjs($user);
        }
        if ($publicaciones === '1') {
            $this->actionBorrarPublicaciones($user);
        }
    }

    /**
     * Borra todo rastro del usuario.
     * @param  User $user
     */
    public function actionBorrarRastro($user)
    {
        $id = $user->id;
        $datos = UsuariosDatos::findOne($id);
        $datos->delete();
        Seguidores::deleteAll(['user_id' => $id]);
        Seguidores::deleteAll(['seguidor_id' => $id]);
        MensajesPrivados::updateAll(['del_e' => true], 'emisor_id = ' . $id);
        MensajesPrivados::updateAll(['del_r' => true], 'receptor_id = ' . $id);
        Notificaciones::deleteAll(['user_id' => $id]);
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
