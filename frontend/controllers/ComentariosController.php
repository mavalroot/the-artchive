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
            $post = Yii::$app->request->post();
            $model = new Comentarios([
                'usuario_id' => Yii::$app->user->id,
                'publicacion_id' => $post['publicacion_id'],
                'contenido' => $post['contenido'],
            ]);
            if (isset($post['comentario_id'])) {
                $model->comentario_id = $post['comentario_id'];
            }
            if (!$model->save()) {
                $values = array_map('array_pop', $model->getErrors());
                $imploded = implode('<br />', $values);
                return $imploded;
            }
        }
        return false;
    }

    /**
     * Responder
     * @return string|bool
     */
    public function actionResponder()
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id'); ?>
            <p class="quote-respuesta">
                <span>
                    <?php Yii::t('frontend', 'Responder a:') ?>
                    <a href="#com<?= $id ?>">#<?= $id ?></a>
                </span>
                <span id="limpiar">
                    <span class="glyphicon glyphicon-remove-sign"></span>
                </span>
                <input type="hidden" name="comentario_id" value="<?= $id ?>"/>
                <script type="text/javascript">
                    limpiar();
                </script>
            </p>
            <?php
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
                $model->contenido = Yii::t('frontend', '<em class="text-danger">Este comentario ha sido borrado por <strong>su autor</strong>.</em>');
                $model->deleted = true;
                return $model->save();
            }
        }
        return false;
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
