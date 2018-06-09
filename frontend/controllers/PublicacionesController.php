<?php

namespace frontend\controllers;

use Yii;
use yii\data\Pagination;

use yii\filters\AccessControl;

use common\models\User;
use common\models\Comentarios;
use common\models\Publicaciones;
use common\models\PublicacionesSearch;
use yii\web\NotFoundHttpException;

use common\utilities\ArtchiveCBase;

/**
 * PublicacionesController implements the CRUD actions for Publicaciones model.
 */
class PublicacionesController extends ArtchiveCBase
{
    use \common\utilities\Permisos;
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
                    $this->mustBeMyContent(['update', 'delete']),
                    $this->mustBeLoggedForAll(),
                ],
            ],
        ];
    }

    public function init()
    {
        $this->class = new Publicaciones();
        $this->search = new PublicacionesSearch();
        parent::init();
    }

    public function whatIDo()
    {
        return ['create', 'update', 'find'];
    }

    /**
     * Lists all Publicaciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!($username = Yii::$app->request->get('username')) || !($user = User::findOne(['username' => $username]))) {
            throw new NotFoundHttpException(Yii::t('app', 'La página requerida no existe.'));
        }

        if ($user) {
            $id = $user->id;
        }
        if (isset($id)) {
            return $this->commonIndex([
                'search' => $this->search,
                'where' => ['usuario_id' => $id],
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
        ->select('co.*, count(co.id) as quoted, uc.username, uc.avatar')
        ->from('comentarios co')
        ->joinWith('comentarios qu')
        ->join('join', 'usuarios_completo uc', 'uc.id = co.usuario_id')
        ->where(['co.publicacion_id' => $id, 'co.comentario_id' => null])
        ->groupBy('co.id, uc.username, uc.avatar')
        ->orderBy('co.created_at DESC');

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
        $this->class->usuario_id = Yii::$app->user->id;

        return parent::actionCreate();
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

        return $this->redirect(['/usuarios-completo/view', 'username' => Yii::$app->user->identity->username]);
    }
}
