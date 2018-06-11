<?php

namespace common\utilities;

use Yii;

use yii\helpers\Url;
use yii\helpers\Html;

/**
 *
 */
class ArtchiveBase extends \yii\db\ActiveRecord
{
    use \common\utilities\Historial;
    /**
     * Indica si se debe guardar el historial de insert, update y delete o no.
     *
     * @return bool Por defecto no guarda el historial, para que no lo guarde
     * habría que devolver true.
     */
    public function isHistorialSaved()
    {
        return false;
    }

    /**
     * Devuelve como un string qué propiedad de la clase guarda el "nombre".
     * Por ejemplo: título, nombre, username.
     *
     * @return string
     */
    public function getDataName()
    {
        return 'data-name';
    }

    /**
     * Devuelve el label para crear la Url.
     * @return string
     */
    public function getUrlLabel()
    {
        $label = isset($this->{$this->getDataName()}) ? $this->{$this->getDataName()} : 'Link';
        return $label;
    }

    /**
     * Devuelve qué parámetro se usa para construir la url, que sería una view.
     * Por ejemplo: id, username.
     *
     * @return string Por defecto es 'id'. Para cambiarlo se sobreescribe
     * el método.
     */
    public function getUrlParam()
    {
        return 'id';
    }

    /**
     * Devuelve la url ya formateada en HTML del view correspondiente.
     *
     * @return string
     */
    public function getUrl()
    {
        return Html::a($this->urlLabel, $this->getRawUrl());
    }

    /**
     * Devuelve la url del view correspondiente.
     *
     * @return string
     */
    public function getRawUrl()
    {
        $name = str_replace('_', '-', static::tableName());
        return Url::to([
            "$name/view",
            $this->getUrlParam() => $this->{$this->getUrlParam()}
        ]);
    }

    /**
     * Devuelve el nombre para crear el historial o la notificación.
     * Por ejemplo: 'un mensaje privado', 'un comentario', 'un personaje'.
     *
     * @return string
     */
    public function getUnName()
    {
        return '';
    }

    /**
     * Recibe el mensaje de historial para insert.
     * @return string
     */
    public function getInsertMessage()
    {
        return 'Ha creado ' . $this->getUnName() . '.';
    }

    /**
     * Recibe el mensaje de historial para update.
     * @return string
     */
    public function getUpdateMessage()
    {
        return 'Ha modificado ' . $this->getUnName() . '.';
    }

    /**
     * Devuelve el tipo de historial.
     * @return string
     */
    public function getHistorialTipo()
    {
        return str_replace('_', '-', static::tableName());
    }

    /**
     * Devuelve la referencia del historial.
     * @return int|string
     */
    public function getHistorialReferencia()
    {
        return $this->id;
    }

    /**
     * Recibe el mensaje de historial para delete.
     * @return string
     */
    public function getDeleteMessage()
    {
        return 'Ha eliminado ' . $this->getUnName();
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($this->isHistorialSaved()) {
            if ($insert) {
                $this->crearHistorial($this->getInsertMessage(), $this->getHistorialReferencia(), $this->getHistorialTipo());
            } else {
                $this->crearHistorial($this->getUpdateMessage(), $this->getHistorialReferencia(), $this->getHistorialTipo());
            }
        }

        return true;
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }
        $data = isset($this->{$this->getDataName()}) ? ': "' . $this->{$this->getDataName()} . '"' : '';
        if ($this->isHistorialSaved()) {
            $this->crearHistorial($this->getDeleteMessage() . "$data.", false, false);
        }
        return true;
    }
}
