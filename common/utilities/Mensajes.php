<?php

namespace common\utilities;

use Yii;

use common\models\TiposNotificaciones;

/**
 *

 */
class Mensajes
{
    /**
     * Mensajes de notificación (traducibles).
     * @param  array $conf  Configuración para las notificaciones.
     * 'tipo' => (string|int)
     * 'delante' => (string) iría delante del mensaje de notificación.
     * 'detrás' => (string) iría detrás del mensaje de notificación.
     * @return string       Mensaje listo para mostrar.
     */
    public function mensajesDeNotificacion($conf)
    {
        $tipo = false;
        $delante = false;
        $detras = false;
        extract($conf, EXTR_IF_EXISTS);

        switch ($tipo) {
            case 'mensajes privados':
            case TiposNotificaciones::getNotificacionId('mensajes privados'):
                $mensaje = Yii::t('app', 'Has recibido un mensaje privado');
                break;
            case 'comentarios':
            case TiposNotificaciones::getNotificacionId('comentarios'):
                $mensaje = Yii::t('app', 'Tu publicación ha recibido un comentario');
                break;
            case 'relaciones':
            case TiposNotificaciones::getNotificacionId('relaciones'):
                $mensaje = Yii::t('app', 'Has recibido una solicitud para crear una relación');
                break;
            case 'seguidores':
            case TiposNotificaciones::getNotificacionId('seguidores'):
                $mensaje = Yii::t('app', 'ha comenzado a seguirte');
                break;
            default:
                $mensaje = Yii::t('app', 'Has recibido una notificación');
                break;
        }

        return $delante ?: '' . $mensaje . $detras ?: '' . '.';
    }

    public function mensajeDeSolicitud()
    {
    }
}
