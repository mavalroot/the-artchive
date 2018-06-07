<?php

namespace common\utilities;

use Yii;

use yii\web\NotFoundHttpException;

/**
 *
 */
trait CommonActions
{
    private function commonIndex($array)
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

    private function commonView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    private function commonUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    private function commonDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    private function commonCreate($model)
    {
        $model->usuario_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    private function commonFindModel($id, $class)
    {
        if (($model = $class->findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'La página requerida no existe.'));
    }
}
