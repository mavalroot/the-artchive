<?php

namespace common\utilities;

use Yii;

use common\models\ActividadReciente;

/**
 * Trait para implementar la creación del historial de actividad reciente
 * antes de cualquier acción.
 */
trait Historial
{
    /**
     * Crea una entrada en el historial.
     * @param  string $message Mensaje.
     * @param  string $url     Link.
     * @return bool
     */
    public static function crearHistorial($message, $url)
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
