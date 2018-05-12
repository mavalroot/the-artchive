<?php

namespace common\utilities;

use Yii;

use common\models\ActividadReciente;

/**
 * Clase para implementar la creación del historial de actividad reciente
 * antes de cualquier acción.
 */
trait Notificacion
{
    public static function crearNotificacion($message, $url)
    {
        $actividad = new ActividadReciente();
        $actividad->mensaje = $message;
        if ($url) {
            $actividad->url = $url;
        }
        $actividad->created_by = Yii::$app->user->id;
        return $actividad->validate() && $actividad->save();
    }
}
