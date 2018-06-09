<?php

namespace frontend\controllers;

use Yii;
use yii\data\Pagination;

use yii\filters\AccessControl;

use common\models\Personajes;
use common\models\Relaciones;
use common\models\PersonajesSearch;
use common\models\User;
use yii\web\NotFoundHttpException;

use common\utilities\ArtchiveCBase;

/**
 * PersonajesController implements the CRUD actions for Personajes model.
 */
class PersonajesController extends ArtchiveCBase
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
                    $this->mustBeMyCharacter(['update', 'delete']),
                    $this->mustBeLoggedForAll(),
                ],
            ],
        ];
    }

    public function init()
    {
        $this->class = new Personajes();
        $this->search = new PersonajesSearch();
        parent::init();
    }

    public function whatIDo()
    {
        return ['create', 'update', 'find'];
    }

    /**
     * Lists all Personajes models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!($username = Yii::$app->request->get('username'))) {
            throw new NotFoundHttpException(Yii::t('app', 'La página requerida no existe.'));
        }
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
    }

    /**
     * Displays a single Personajes model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $query = Relaciones::find()
        ->select('r.id, r.nombre, r.referencia, mipj.nombre as mipj, mipj.id as mipjid, supj.nombre as supj, supj.id as supjid, tr.tipo_es as relacion, tr.tipo_en relationship, s.aceptada')
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
        $this->class->usuario_id = Yii::$app->user->id;
        return parent::actionCreate();
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
}
