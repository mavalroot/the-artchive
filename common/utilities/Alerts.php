<?php

namespace common\utilities;

use Yii;
use yii\base\Model;

/**
 * Trait para manejar las alertas.
 */
trait Alerts
{
    /**
     * Devuelve las notificaciones que no se han visto.
     * @param  Model $model  Modelo·
     * @param  string $prop  Propiedad que contiene el id del usuario.
     * @return Model
     */
    public function getUnseenAlerts($model, $prop)
    {
        return $model->find()->where([$prop => $this->id, 'seen' => false])->count();
    }

    /**
     * Hace que todas las notificaciones pasen a estar "vistas"
     * @param  Model $model  Modelo·
     * @param  string $prop  Propiedad que contiene el id del usuario.
     */
    public function setSeenAllAlerts($model, $prop)
    {
        $model->updateAll(['seen' => true], "$prop = " . $this->id);
    }

    /**
     * Hace que un modelo en concreto pase a visto.
     * @param  Model $model  Modelo·
     * @param  string $prop  Propiedad que contiene el id del usuario.
     */
    public function setSeen($model, $prop)
    {
        if ($model->$prop == Yii::$app->user->id) {
            $model->seen = true;
            return $model->save();
        }
        return false;
    }
}
