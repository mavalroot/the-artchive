<?php

namespace frontend\controllers;

use Yii;
use common\models\Comentarios;
use common\models\ComentariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComentariosController implements the CRUD actions for Comentarios model.
 */
class ComentariosController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Comentarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComentariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comentarios model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Comentarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $post = Yii::$app->request->post();
        if ($post) {
            $model = new Comentarios();
            $model->usuario_id = Yii::$app->user->id;
            $model->publicacion_id = $post['publicacion_id'];
            $model->contenido = $post['contenido'];
            if (Yii::$app->request->post('comentario_id')) {
                $model->comentario_id = $post['comentario_id'];
            }
            if ($model->save()) {
                return 'true';
            } else {
                $values = array_map('array_pop', $model->getErrors());
                $imploded = implode('<br />', $values);
                return $imploded;
            }
        }
    }

    /**
     * Responder
     * @return [type] [description]
     */
    public function actionResponder()
    {
        if (Yii::$app->request->post('id')) {
            $id = Yii::$app->request->post('id'); ?>
            <p class="quote-respuesta">
                <span>Responder a: <a href="#com<?= $id ?>">#<?= $id ?></a></span>
                <span id="limpiar"><span class="glyphicon glyphicon-remove-sign"></span></span>
                <input type="hidden" name="comentario_id" value="<?= $id ?>"/>
                <script type="text/javascript">
                    limpiar();
                </script>
            </p>
            <?php
        }
    }

    /**
     * Deletes an existing Comentarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        if (Yii::$app->request->post('id')) {
            $id = Yii::$app->request->post('id');
            $model = $this->findModel($id);
            if ($model->isMine() && !$model->isDeleted()) {
                $model->contenido = '<em class="text-danger">Este comentario ha sido borrado por su <strong>autor</strong>.</em>';
                $model->deleted = true;
                return $model->save();
            }
        }
        return false;
    }

    /**
     * Finds the Comentarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comentarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comentarios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
