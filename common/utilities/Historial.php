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
    public function crearHistorial($message, $referencia, $tipo)
    {
        $actividad = new ActividadReciente();
        $actividad->mensaje = $message;
        if ($referencia && $tipo) {
            $actividad->referencia = $referencia;
            $actividad->tipo = $tipo;
        }
        $actividad->created_by = Yii::$app->user->id;
        return $actividad->save();
    }
}
