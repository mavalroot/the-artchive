<?php

namespace frontend\controllers;

use Yii;
use yii\data\Pagination;

use yii\filters\AccessControl;

use common\models\Personajes;
use common\models\Relaciones;
use common\models\PersonajesSearch;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PersonajesController implements the CRUD actions for Personajes model.
 */
class PersonajesController extends Controller
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
                    $this->mustBeLoggedForAll(),
                    $this->mustBeMyCharacter(['update', 'delete']),
                ],
            ],
        ];
    }

    /**
     * Lists all Personajes models.
     * @param string $username
     * @return mixed
     */
    public function actionIndex($username)
    {
        $user = User::findOne(['username' => $username]);

        if ($user) {
            $id = $user->id;
        }
        if (isset($id)) {
            $searchModel = new PersonajesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $dataProvider->query->where(['usuario_id' => $id]);


            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Personajes model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        // select r.id, mipj.nombre as mipj, tupj.nombre as tupj, tp.tipo as relacion from relaciones r join personajes mipj on mipj.id = r.personaje_id join personajes tupj on tupj.id = r.referencia join tipos_relaciones tp on r.tipo_relacion_id = tp.id;
        //
        $query = Relaciones::find()
        ->select('r.id, r.nombre, r.referencia, mipj.nombre as mipj, mipj.id as mipjid, supj.nombre as supj, supj.id as supjid, tr.tipo as relacion, s.aceptada')
        ->from('relaciones r')
        ->joinWith('personaje mipj')
        ->joinWith('referencia supj')
        ->joinWith('tipoRelacion tr')
        ->joinWith('solicitudes s')
        ->where(['personaje_id' => $id]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->setPageSize(5);
        $relaciones = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'relaciones' => $relaciones,
            'pagination' => $pages,
        ]);
    }

    /**
     * Creates a new Personajes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Personajes();

        $model->usuario_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Personajes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Personajes model.
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

    /**
     * Finds the Personajes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Personajes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Personajes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'La página requerida no existe.'));
    }
}
