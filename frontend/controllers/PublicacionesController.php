<?php

namespace frontend\controllers;

use Yii;
use yii\data\Pagination;

use yii\filters\AccessControl;

use common\models\User;
use common\models\Comentarios;
use common\models\Publicaciones;
use common\models\PublicacionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PublicacionesController implements the CRUD actions for Publicaciones model.
 */
class PublicacionesController extends Controller
{
    use \common\utilities\Permisos;
    use \common\traitrollers\PublicacionesComun;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => $this->paramByPost(['delete']),
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    $this->mustBeLoggedForAll(),
                    $this->mustBeMyContent(['update', 'delete']),
                ],
            ],
        ];
    }

    /**
     * Lists all Publicaciones models.
     * @param  string $username Nombre de usuario del propietario de
     * las publicaciones.
     * @return mixed
     */
    public function actionIndex($username)
    {
        $user = User::findOne(['username' => $username]);

        if ($user) {
            $id = $user->id;
        }
        if (isset($id)) {
            $searchModel = new PublicacionesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $dataProvider->query->where(['usuario_id' => $id]);


            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Publicaciones model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $query = Comentarios::find()
        ->select('co.*, count(co.id) as quoted')
        ->from('comentarios co')
        ->joinWith('comentarios qu')
        ->where(['co.publicacion_id' => $id])
        ->groupBy('co.id')
        ->orderBy('co.created_at ASC');

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->setPageSize(5);
        $comentarios = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'comentarios' => $comentarios,
            'pagination' => $pages,
        ]);
    }

    /**
     * Creates a new Publicaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Publicaciones();
        $model->usuario_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Publicaciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'username' => Yii::$app->user->identity->username]);
    }
}
