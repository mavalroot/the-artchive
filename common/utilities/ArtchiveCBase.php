<?php

namespace common\utilities;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Clase base para los controladores
 */
class ArtchiveCBase extends Controller
{
    /**
     * @var \Yii\db\ActiveRecord
     */
    protected $class;
    /**
     * @var \Yii\db\ActiveRecord
     */
    protected $search;

    /**
     * Qué acciones hace. Por defecto hará todas. Se debe especificar de
     * forma individual.
     * @return array
     */
    public function whatIDo()
    {
        return ['index', 'view', 'update', 'delete', 'create', 'find'];
    }

    /**
     * Devuelve si debe hacer una determinada acción.
     * @param  string $what la acción
     * @return bool
     */
    public function getIfIDo($what)
    {
        $do = $this->whatIDo();

        return in_array($what, $do);
    }

    /**
     * Index.
     * @return mixed
     */
    public function actionIndex()
    {
        if ($this->getIfIDo('index')) {
            return $this->commonIndex([
                'search' => $this->search,
            ]);
        }
    }

    /**
     * View.
     * @param  int|string $id Clave primaria distintiva.
     * @return mixed
     */
    public function actionView($id)
    {
        if ($this->getIfIDo('view')) {
            return $this->commonView($id);
        }
    }

    /**
     * Actualiza el modelo.
     * @param  string|int $id Clave primaria distintiva.
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if ($this->getIfIDo('update')) {
            return $this->commonUpdate($id);
        }
    }

    /**
     * Borra el modelo.
     * @param  string|int $id Clave primaria distintiva.
     * @return mixed
     */
    public function actionDelete($id)
    {
        if ($this->getIfIDo('delete')) {
            return $this->commonDelete($id);
        }
    }

    /**
     * Crea uno nuevo.
     * @return mixed
     */
    public function actionCreate()
    {
        if ($this->getIfIDo('create')) {
            return $this->commonCreate($this->class);
        }
    }

    /**
     * Encuentra un modelo.
     * @param  string|int $id Clave primaria distintiva.
     * @return \Yii\db\ActiveRecord
     */
    public function findModel($id)
    {
        if ($this->getIfIDo('find')) {
            return $this->commonFindModel($id, $this->class);
        }
    }

    /**
     * Ayuda a crear el index
     * @param  array $array Configuración.
     * @return mixed
     */
    protected function commonIndex($array)
    {
        extract($array);

        if (!isset($search)) {
            throw new NotFoundHttpException(Yii::t('app', 'La página requerida no existe.'));
        }
        $dataProvider = $search->search(Yii::$app->request->queryParams);

        if (isset($where)) {
            $dataProvider->query->where($where);
        }

        if (isset($order)) {
            $dataProvider->query->orderBy($order);
        }

        return $this->render('index', [
            'searchModel' => $search,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Ayuda a crear la view.
     * @param  string|int $id Clave primaria distintiva.
     * @return mixed
     */
    protected function commonView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Ayuda a crear el update.
     * @param  string|int $id Clave primaria distintiva.
     * @return mixed
     */
    protected function commonUpdate($id)
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
     * Ayuda a crear el delete.
     * @param  string|int $id Clave primaria distintiva.
     * @return mixed
     */
    protected function commonDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Ayuda a crear el create.
     * @param  \Yii\db\ActiveRecord $model Modelo del que se creará.
     * @return mixed
     */
    protected function commonCreate($model)
    {
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Ayuda a encontrar el modelo.
     * @param  string|int $id Clave primaria distintiva.
     * @param  \Yii\db\ActiveRecord $class Tipo de modelo.
     * @return mixed
     * @throws NotFoundHttpException
     */
    protected function commonFindModel($id, $class)
    {
        if (($model = $class->findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'La página requerida no existe.'));
    }
}
