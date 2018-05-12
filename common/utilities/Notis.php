<?php

namespace common\utilities;

use yii\helpers\Url;
use yii\helpers\Html;

use common\models\Notificaciones;
use common\models\TiposNotificaciones;

/**
 *
 */
class Notis extends \yii\db\ActiveRecord
{
    public function getNotificacionContenido()
    {
        return 'Has recibido una notificacion';
    }

    public function getNotificacionTipo()
    {
        $nombre = strtolower(str_replace('_', ' ', static::tableName()));
        $tipo = TiposNotificaciones::findOne(['tipo' => $nombre]);
        return $tipo->id;
    }

    public function getNotificacionReceptor()
    {
        return 'usuario_id';
    }

    public function getNotificacionVistaId()
    {
        return;
    }

    public function getNotificacionUrl()
    {
        $name = str_replace('_', '-', static::tableName());
        return Url::to([$name . '/view', 'id' => $this->getNotificacionVistaId()]);
    }

    public function createNotificacion()
    {
        $contenido = Html::a(
            $this->getNotificacionContenido(),
            $this->getNotificacionUrl()
        );
        $receptor = $this->{$this->getNotificacionReceptor()};
        $noti = new Notificaciones([
            'notificacion' => $contenido,
            'usuario_id' => $receptor,
            'tipo_notificacion_id' => $this->getNotificacionTipo(),
        ]);
        return $noti->save();
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->createNotificacion();
        }
    }
}
