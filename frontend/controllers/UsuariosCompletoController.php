<?php

namespace frontend\controllers;

use Yii;
use yii\data\Pagination;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\Seguidores;
use common\models\Publicaciones;
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
        $query = Publicaciones::find()
        ->where(['usuario_id' => $model->id])
        ->orderBy('created_at DESC');

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->setPageSize(5);
        $publicaciones = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('view', [
            'model' => $model,
            'publicaciones' => $publicaciones,
            'pagination' => $pages,
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

            if ($block->validate() && $block->save()) {
                $model = $this->findModel(Yii::$app->user->identity->username);
                $model->bloquearSeguidor($id);

                return true;
            }
        }
        return false;
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
