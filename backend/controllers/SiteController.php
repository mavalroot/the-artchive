<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\PersonajesSearch;
use common\models\PublicacionesSearch;
use common\models\UsuariosCompletoSearch;
use common\models\ActividadRecienteSearch;

/**
 * Site controller
 */
class SiteController extends Controller
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
                'rules' => [
                    $this->mustBeAdmin(['index']),
                    $this->anyCanAccess(['login', 'error']),
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $params['usuarios'] = new UsuariosCompletoSearch();
        $params['personajes'] = new PersonajesSearch();
        $params['publicaciones'] = new PublicacionesSearch();
        $params['reciente'] = new ActividadRecienteSearch();

        foreach (array_keys($params) as $key) {
            $params[$key] = $params[$key]->search(Yii::$app->request->queryParams);
            $params[$key]->query->orderBy(['created_at' => SORT_DESC])->limit(5);
            $params[$key]->sort = false;
            $params[$key]->pagination = false;
        }

        return $this->render('index', $params);
    }

    /**
     * Login action.
     *
     * @return string
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
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
