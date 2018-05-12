<?php

namespace common\utilities;

use yii\helpers\Html;

use common\models\Notificaciones;
use common\models\TiposNotificaciones;

/**
 *
 */
class BaseNotis extends \common\utilities\ArtchiveBase
{
    /**
     * Indica si se debe enviar una notificación al crear.
     *
     * @return bool Por defecto no se manda. Para que se mande habría que
     * devolver true.
     */
    public function isNotificacionSaved()
    {
        return true;
    }

    /**
     * Crea el contenido de una notificación.
     *
     * @return string
     */
    public function getNotificacionContenido()
    {
        $name = $this->getUnName();
        return "Has recibido $name.";
    }

    /**
     * Devuelve el tipo de notificación basándose en el nombre de la tabla.
     * @return string
     */
    public function getNotificacionTipo()
    {
        $nombre = strtolower(str_replace('_', ' ', static::tableName()));
        $tipo = TiposNotificaciones::findOne(['tipo' => $nombre]);
        return $tipo->id;
    }

    /**
     * Devuelve el id que indica quién recibe la notificación.
     * Por defecto es el usuario_id de la clase actual.
     *
     * @return int
     */
    public function getNotificacionReceptor()
    {
        return $this->usuario_id;
    }

    /**
     * Devuelve la url de la notificación en caso de que sea diferente a la
     * url general.
     *
     * @return string|bool
     */
    public function getNotificacionUrl()
    {
        return false;
    }

    /**
     * Crea la notificación.
     *
     * @return bool Verdadero si se ha creado satisfactoriamente y falso si no.
     */
    public function createNotificacion()
    {
        $contenido = Html::a(
            $this->getNotificacionContenido(),
            $this->getNotificacionUrl() ?: $this->getRawUrl()
        );
        $noti = new Notificaciones([
            'notificacion' => $contenido,
            'usuario_id' => $this->getNotificacionReceptor(),
            'tipo_notificacion_id' => $this->getNotificacionTipo(),
        ]);
        return $noti->save();
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($this->isNotificacionSaved() && $insert) {
            $this->createNotificacion();
        }
        
        return true;
    }
}
