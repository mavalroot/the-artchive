<?php

namespace common\traitrollers;

use Yii;

use yii\base\Model;

/**
 *
 */
trait CommonIndex
{
    /**
     * En común con la acción index y sent.
     * @param  Model  $model Modelo de búsqueda
     * @param  array  $where where de la query
     * @param  string $name  nombre de la acción
     * @return mixed
     */
    private function commonIndex($model, $where, $name)
    {
        $searchModel = $model;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where($where);

        return $this->render($name, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
