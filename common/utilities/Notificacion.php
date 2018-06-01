<?php

namespace common\utilities;

use Yii;

use common\models\Notificaciones;
use common\models\TiposNotificaciones;

/**
 * Clase para implementar la creación del historial de notificacion reciente
 * antes de cualquier acción.
 */
trait Notificacion
{
    /**
     * Crea una notificación.
     * @param  array $params Parámetros para construir la notificación. Se pide:
     * 'url' => (stromg) opcional. Url de la notificación.
     * 'user' => id del usuario. Por defecto será el id de usuario_id
     * (si existe).
     * @return bool
     */
    public function crearNotificacion($params)
    {
        $user = false;
        $url = null;
        extract($params, EXTR_IF_EXISTS);
        if (!$message) {
            return false;
        }
        $notificacion = new Notificaciones();
        $notificacion->url = $url;
        $notificacion->tipo_notificacion_id = $this->getNotificacionTipo();
        if ($this->getNotificacionUser($user)) {
            $notificacion->usuario_id = $this->getNotificacionUser($user);
        } else {
            return false;
        }
        return $notificacion->save();
    }

    /**
     * Devuelve el tipo de notificación basándose en el nombre de la tabla.
     * @return string
     */
    private function getNotificacionTipo()
    {
        $nombre = strtolower(str_replace('_', ' ', static::tableName()));
        $tipo = TiposNotificaciones::findOne(['tipo' => $nombre]);
        return $tipo->id;
    }

    private function getNotificacionUser($user)
    {
        if (!$user) {
            if (!$this->usuario_id) {
                return false;
            } else {
                return $this->usuario_id;
            }
        }
        return $user;
    }
}
