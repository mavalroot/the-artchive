<?php

namespace common\utilities;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 *
 */
class ArtchiveCBase extends Controller
{
    protected $class;
    protected $search;

    public function actionIndex()
    {
        return $this->commonIndex([
            'search' => $this->search,
        ]);
    }

    public function actionView($id)
    {
        return $this->commonView($id);
    }

    public function actionUpdate($id)
    {
        return $this->commonUpdate($id);
    }

    public function actionDelete($id)
    {
        return $this->commonDelete($id);
    }

    public function actionCreate()
    {
        return $this->commonCreate($this->class);
    }

    public function findModel($id)
    {
        return $this->commonFindModel($id, $this->class);
    }

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

    protected function commonView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

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

    protected function commonDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function commonCreate($model)
    {
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    protected function commonFindModel($id, $class)
    {
        if (($model = $class->findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'La página requerida no existe.'));
    }
}
