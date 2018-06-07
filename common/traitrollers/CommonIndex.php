<?php

namespace common\traitrollers;

use Yii;

/**
 *
 */
trait CommonIndex
{
    /**
     * En común con la acción index y sent.
     * @param  array $config Configuración: model, where, name
     * (obligatorios) y order.
     * @return mixed
     */
    private function commonIndex($config)
    {
        extract($config);
        if (!isset($model, $where, $name)) {
            return false;
        }
        $dataProvider = $model->search(Yii::$app->request->queryParams);
        $dataProvider->query->where($where);

        if (isset($order)) {
            $dataProvider->query->orderBy($order);
        }

        return $this->render($name, [
            'searchModel' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }
}
