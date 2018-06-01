<?php

namespace common\utilities;

use Yii;

use common\models\TiposNotificaciones;
use common\models\User;

/**
 *

 */
trait Mensajes
{
    /**
     * Mensajes de notificación (traducibles).
     * @param  array $conf  Configuración para las notificaciones.
     * 'tipo' => (string|int)
     * 'delante' => (string) iría delante del mensaje de notificación.
     * 'detrás' => (string) iría detrás del mensaje de notificación.
     * @return string       Mensaje listo para mostrar.
     */
    public function mensajesDeNotificacion($tipo)
    {
        $mensaje = '';
        $delante = '';
        $detras = '';
        switch ($tipo) {
            case TiposNotificaciones::getNotificacionId('mensajes privados'):
                $mensaje = Yii::t('app', 'Has recibido un mensaje privado de');
                $detras = $this->mensajeDeNotificacionEmisor();
                break;
            case TiposNotificaciones::getNotificacionId('comentarios'):
                $mensaje = Yii::t('app', 'ha comentado tu publicación');
                $delante = $this->mensajeDeNotificacionEmisor() . ' ';
                break;
            case TiposNotificaciones::getNotificacionId('relaciones'):
                $mensaje = Yii::t('app', 'Has recibido una solicitud para crear una relación');
                break;
            case TiposNotificaciones::getNotificacionId('seguidores'):
                $mensaje = Yii::t('app', 'ha comenzado a seguirte');
                $delante = $this->mensajeDeNotificacionEmisor() . ' ';
                break;
            default:
                $mensaje = Yii::t('app', 'Has recibido una notificación');
                break;
        }

        return $delante . $mensaje . $detras . '.';
    }

    private function mensajeDeNotificacionEmisor()
    {
        return User::findOne($this->created_by)->username;
    }
}
