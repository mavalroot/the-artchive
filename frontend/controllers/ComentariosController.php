<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\Comentarios;
use yii\web\NotFoundHttpException;

use common\models\TiposUsuario;
use common\models\ComentariosSearch;

use common\utilities\ArtchiveCBase;

/**
 * ComentariosController implements the CRUD actions for Comentarios model.
 */
class ComentariosController extends ArtchiveCBase
{
    use \common\utilities\Permisos;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => $this->paramByPost(['delete']),
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
        $this->class = new Comentarios();
        $this->search = new ComentariosSearch();
        parent::init();
    }

    public function whatIDo()
    {
        return ['find'];
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
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id = '')
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $model = $this->findModel($id);
            $imAdmin = Yii::$app->user->identity->tipo_usuario == TiposUsuario::getOne(TiposUsuario::ADMIN);
            if (($model->isMine() || $imAdmin) && !$model->isDeleted()) {
                $model->contenido = '--Comentario eliminado--';
                $model->deleted = true;
                return $model->save();
            }
        }
        return false;
    }

    /**
     * Muestra las respuestas del comentario.
     * @return mixed
     */
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
            return '<div class="no-respuestas">' . Yii::t('app', 'No hay comentarios.') . '</div>';
        }
    }
}
