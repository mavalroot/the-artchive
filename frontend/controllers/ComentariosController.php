<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\Comentarios;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ComentariosController implements the CRUD actions for Comentarios model.
 */
class ComentariosController extends Controller
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
                    $this->mustBeLoggedForAll(),
                ],
            ],
        ];
    }

    /**
     * Creates a new Comentarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->request->isAjax) {
            $model = new Comentarios();
            $model->usuario_id = Yii::$app->user->id;
            if (!($model->load(Yii::$app->request->post()) && $model->save())) {
                $values = array_map('array_pop', $model->getErrors());
                $imploded = implode('<br />', $values);
                return $imploded;
            }
            return true;
        }
    }

    /**
     * Responder
     * @return string|bool
     */
    public function actionResponder()
    {
        if (Yii::$app->request->isAjax) {
            $this->layout = false;
            $id = Yii::$app->request->post('id');
            $publicacion = Yii::$app->request->post('publicacion');
            return $this->render('_responder', [
                'model' => new Comentarios(),
                'publicacion' => $publicacion,
                'comentario' => $id
            ]);
        }
        return false;
    }

    /**
     * Deletes an existing Comentarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $model = $this->findModel($id);
            if ($model->isMine() && !$model->isDeleted()) {
                $model->contenido = '--Comentario eliminado--';
                $model->deleted = true;
                return $model->save();
            }
        }
        return false;
    }

    public function actionMostrarRespuestas()
    {
        if (Yii::$app->request->isAjax) {
            $this->layout = false;
            $id = Yii::$app->request->post('id');
            $model = $this->findModel($id);

            $comentarios = $model->getComentarios()
            ->select('comentarios.*, count(comentarios.id) as quoted, uc.username, uc.avatar')
            ->joinWith('comentarios qu')
            ->join('join', 'usuarios_completo uc', 'uc.id = comentarios.usuario_id')
            ->groupBy('comentarios.id, uc.username, uc.avatar')
            ->orderBy('comentarios.created_at ASC')
            ->all();

            if (count($comentarios)) {
                return $this->render('_respuestas', [
                    'comentarios' => $comentarios,
                ]);
            }
            return '<div class="no-respuestas">No hay comentarios.</div>';
        }
    }

    /**
     * Finds the Comentarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Comentarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comentarios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'La página requerida no existe.'));
    }
}
