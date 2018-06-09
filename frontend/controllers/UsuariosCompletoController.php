<?php

namespace frontend\controllers;

use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use common\models\Seguidores;
use common\models\Publicaciones;
use common\models\Notificaciones;
use common\models\MensajesPrivados;
use common\models\UsuariosCompleto;
use common\models\UsuariosCompletoSearch;
use yii\web\NotFoundHttpException;
use common\models\Bloqueos;
use common\utilities\ArtchiveCBase;

/**
 * UsuariosCompletoController implements the CRUD actions for UsuariosCompleto model.
 */
class UsuariosCompletoController extends ArtchiveCBase
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
        $this->class = new UsuariosCompleto();
        $this->search = new UsuariosCompletoSearch();
        parent::init();
    }

    public function whatIDo()
    {
        return ['find'];
    }

    /**
     * Displays a single UsuariosCompleto model.
     * @param string $username
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($username)
    {
        // select p.*, count(c.id) as comentarios from publicaciones p left join comentarios c on p.id = c.usuario_id group by p.id;
        $model = $this->findModel($username);
        $query = Publicaciones::find()
        ->select('p.*, count(c.id) as numcom')
        ->from('publicaciones p')
        ->leftJoin('comentarios c', 'p.id = c.publicacion_id')
        ->where(['p.usuario_id' => $model->id])
        ->orderBy('p.created_at DESC')
        ->groupBy('p.id');

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

    /**
     * Deja de seguir a un usuario.
     * @return bool
     */
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

    /**
     * Bloquea a un usuario.
     * @return bool
     */
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

    /**
     * Desloquea a un usuario.
     * @return bool
     */
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
     * Devuelve el número de alertas (notificaciones y mensajes privados).
     */
    public function actionNumalerts()
    {
        $model = $this->findModel(Yii::$app->user->identity->username);
        $data = [
            'notis' => Notificaciones::find()->where(['usuario_id' => $model->id, 'seen' => false])->count(),
            'mps' => MensajesPrivados::find()->where(['receptor_id' => $model->id, 'seen' => false])->count(),
        ];

        header('Content-type: application/json');
        echo json_encode($data);
    }
}
