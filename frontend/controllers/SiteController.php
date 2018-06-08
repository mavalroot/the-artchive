<?php
namespace frontend\controllers;

use Yii;

use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use common\models\LoginForm;
use common\models\Seguidores;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\UsuariosCompleto;
use common\models\Publicaciones;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
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
                'only' => ['logout', 'signup'],
                'rules' => [
                    $this->mustBeGuest(['signup']),
                    $this->mustBeLogged(['logout']),
                ],
            ],
            'verbs' => $this->paramByPost(['logout']),

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $this->layout = 'homeguests';
            return $this->render('index', [
                'model' => new LoginForm(),
            ]);
        } else {
            $this->layout = 'main-without-foot';
            $publicaciones = Publicaciones::find()->where([
                'usuario_id' => ArrayHelper::map(
                    Seguidores::find()
                    ->where([
                        'seguidor_id' => Yii::$app->user->id
                    ])
                    ->all(),
                    'id',
                    'usuario_id'
                )]);
            return $this->render('index', [
                'model' => UsuariosCompleto::findOne(['id' => Yii::$app->user->id]),
                'publicaciones' => $publicaciones,
            ]);
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', Yii::t('frontend', 'Gracias por contactarnos. Responderemos lo más pronto posible.'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('frontend', 'Hubo un error enviando tu mensaje.'));
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $this->layout = 'homeguests';
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $this->sendMail($model);
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Manda el mail para confirmar la cuenta.
     * @param  SignupForm $model
     * @return mixed
     */
    private function sendMail($model)
    {
        if ($user = $model->signup()) {
            $mensaje = Yii::t('frontend', 'Para confirmar su cuenta haga click en el siguiente enlace:') . ' <a href="' . Yii::$app->urlManager->createAbsoluteUrl(
                ['site/confirm', 'id' => $user->id, 'key' => $user->auth_key]
            ).'">' . Yii::t('frontend', 'Confirmación') . '</a>';
            $email = \Yii::$app->mailer->compose()
             ->setTo($user->email)
             ->setFrom([Yii::$app->params[0]['adminEmail'] => Yii::$app->name . ' robot'])
             ->setSubject(Yii::t('frontend', 'Confirmación de cuenta'))
             ->setTextBody($mensaje)
             ->send();

            if ($email) {
                Yii::$app->getSession()->setFlash('success', Yii::t('frontend', 'Se ha enviado un correo de confirmación.'));
            } else {
                Yii::$app->getSession()->setFlash('warning', Yii::t('frontend', 'Ha habido un error, conctacte con el administrador.'));
            }
            return $this->goHome();
        }
    }

    /**
     * Confirmación de usuario registrado.
     * @param  int      $id  id del usuario
     * @param  string   $key clave de autenticacion (auth_key) del usuario
     */
    public function actionConfirm($id, $key)
    {
        $user = \common\models\User::find()->where(
            [
                'id' => $id,
                'auth_key' => $key,
                'status' => 20,
            ]
        )
        ->one();

        if (!empty($user)) {
            $user->status=10;
            $user->save();
            Yii::$app->getSession()->setFlash('success', Yii::t('frontend', 'Cuenta activada, puede conectarse.'));
        } else {
            Yii::$app->getSession()->setFlash('warning', Yii::t('frontend', 'No se ha podido activar la cuenta.'));
        }

        return $this->goHome();
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', Yii::t('frontend', 'Vea su correo para más información.'));

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', Yii::t('frontend', 'Lo siento, no hemos podido enviar un reseteo de contraseña al email facilitado.'));
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', Yii::t('frontend', 'Nueva contraseña guardada.'));

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Switches the language and redirects back
     */
    public function actionSwitchLanguage()
    {
        Yii::$app->cookieLanguageSelector->setLanguage(Yii::$app->request->post('language'));
        if (!Yii::$app->request->isAjax) {
            $this->redirect(Yii::$app->request->post('redirectTo', ['site/index']));
        }
    }
}
