<?php

namespace common\utilities;

use Yii;

use yii\helpers\Url;
use yii\helpers\Html;

use common\models\User;

/**
 *
 */
class ArtchiveBase extends \yii\db\ActiveRecord
{
    use \common\utilities\Historial;
    /**
     * Indica si se debe guardar el historial de insert, update y delete o no.
     *
     * @return bool Por defecto guarda el historial, para que no lo guarde
     * habría que devolver falso.
     */
    public function isHistorialSaved()
    {
        return true;
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
     * Muestra el botón para exportar a pdf.
     *
     * @return string
     */
    public function getExportButton()
    {
        if ($this->isMine()) {
            $data = isset($this->{$this->getDataName()}) ? $this->{$this->getDataName()} : '';
            return Html::a('<i class="fas fa-save"></i> ' . Yii::t('app', 'Guardar como pdf'), ['#'], ['id' => 'export', 'data-name' => $data]);
        }
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
     * Indica si esta instancia es propiedad del usuario conectado actualmente.
     * Para ello primero se comprueba que exista la propiedad usuario_id, porque
     * en caso contrario no es una clase que pueda tener pertenencia.
     *
     * @return bool
     */
    public function isMine()
    {
        if (isset($this->usuario_id)) {
            return $this->usuario_id == Yii::$app->user->id;
        }
        return false;
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
        return Yii::t('app', 'Ha creado ') . $this->getUnName() . '.';
    }

    /**
     * Recibe el mensaje de historial para update.
     * @return string
     */
    public function getUpdateMessage()
    {
        return Yii::t('app', 'Ha modificado ') . $this->getUnName() . '.';
    }

    public function getHistorialTipo()
    {
        return str_replace('_', '-', static::tableName());
    }

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
        return Yii::t('app', 'Ha eliminado ') . $this->getUnName();
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
