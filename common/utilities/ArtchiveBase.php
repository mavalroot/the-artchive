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
    public function getDataName()
    {
        return 'data-name';
    }
    /**
     * Muestra el botón para exportar a pdf.
     * @return string
     */
    public function getExportButton()
    {
        if ($this->isMine()) {
            return Html::button('Guardar como pdf', ['id' => 'export', 'data-name' => $this->{$this->getDataName()}, 'class' => 'btn btn-sm btn-primary']);
        }
    }

    public function getUrlLabel()
    {
        return $this->{$this->getDataName()};
    }

    public function getUrlParam()
    {
        return 'id';
    }

    /**
     * Devuelve un array con la url del view de ese personaje.
     * @return array
     */
    public function getUrl()
    {
        return Html::a($this->urlLabel, $this->getRawUrl());
    }

    public function getRawUrl()
    {
        $name = str_replace('_', '-', static::tableName());
        Url::to([
            "$name/view",
            $this->getUrlParam() => $this->{$this->getUrlParam()}
        ]);
    }

    public function isMine()
    {
        if (isset($this->usuario_id)) {
            return $this->usuario_id == Yii::$app->user->id;
        }
        return false;
    }

    public function getCreator()
    {
        if (isset($this->usuario_id)) {
            return $this->hasOne(User::className(), ['id' => 'usuario_id']);
        }
        return null;
    }

    /**
     * Muestra el creador del personaje como un link
     * @return string
     */
    public function getUrlCreator()
    {
        if (isset($this->creator)) {
            return Html::a($this->creator, ['/usuarios-completo/view', 'username' => $this->creator]);
        }
        return null;
    }

    public function getHistorialName()
    {
        return 'un registro';
    }

    public function getHistorialMessage($tipo)
    {
        $name = $this->getHistorialName();

        switch ($tipo) {
            case 'insert':
                return "Ha creado $name.";
            case 'update':
                return "Ha modificado $name.";
            case 'delete':
                return "Ha borrado $name: \"";
            default:
                break;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            Historial::crearHistorial($this->getHistorialMessage('insert'), $this->getUrl());
        } else {
            Historial::crearHistorial($this->getHistorialMessage('update'), $this->getUrl());
        }
        return true;
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }
        Historial::crearHistorial($this->getHistorialMessage('delete') . $this->nombre . '".', false);
        return true;
    }
}
