<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\Seguidores;
use common\models\SeguidoresSearch;
use common\models\User;
use yii\web\NotFoundHttpException;

use common\utilities\ArtchiveCBase;

/**
 * SeguidoresController implements the CRUD actions for Seguidores model.
 */
class SeguidoresController extends ArtchiveCBase
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

    public function init()
    {
        $this->class = new Seguidores();
        $this->search = new SeguidoresSearch();
        parent::init();
    }

    /**
     * Lists all Seguidores models.
     * @param string $username Nombre de usuario.
     * @return mixed
     */
    public function actionIndex($username)
    {
        $user = User::findOne(['username' => $username]);

        if ($user) {
            $id = $user->id;
        }

        if (isset($id)) {
            return $this->commonIndex([
                'search' => $this->search,
                'where' => ['usuario_id' => $id],
            ]);
        }
        throw new NotFoundHttpException(Yii::t('app', 'La página requerida no existe.'));
    }

    /**
     * Hace que un usuario siga a otro.
     * @param  string $username Nombre de usuario.
     * @return mixed
     */
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
        throw new NotFoundHttpException(Yii::t('app', 'La página requerida no existe.'));
    }
}
