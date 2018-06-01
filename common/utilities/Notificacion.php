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
    /**
     * Crea una notificación.
     * @param  array $params Parámetros para construir la notificación. Se pide:
     * 'message' => (string) requerido.
     * 'url' => (string) opcional.
     * 'tipo' => (string) opcional. Por defecto será el nombre de la tabla de
     * la clase en la que nos encontremos.
     * @return bool
     */
    public function crearNotificacion($params)
    {
        $message = false;
        $url = false;
        $tipo = false;
        extract($params, EXTR_IF_EXISTS);

        if (!$message) {
            return false;
        }

        $actividad = new ActividadReciente();
        $actividad->mensaje = $message;
        if ($url) {
            $actividad->url = $url;
        }
        if (!$tipo) {
            $actividad->tipo_notificacion_id = strtolower(str_replace('_', ' ', static::tableName()));
        } else {
            $actividad->tipo_notificacion_id = $tipo;
        }

        $actividad->created_by = Yii::$app->user->id;
        return $actividad->validate() && $actividad->save();
    }
}
