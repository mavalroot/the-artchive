<?php

namespace common\models;

use Yii;

use yii\helpers\Url;

/**
 * This is the model class for table "solicitudes".
 *
 * @property int $id
 * @property int $relacion_id
 * @property bool $aceptada
 *
 * @property Relaciones $relacion
 */
class Solicitudes extends \common\utilities\BaseNotis
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'solicitudes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['relacion_id'], 'default', 'value' => null],
            [['relacion_id'], 'integer'],
            [['aceptada'], 'boolean'],
            [['relacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Relaciones::className(), 'targetAttribute' => ['relacion_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'relacion_id' => 'Relacion ID',
            'aceptada' => 'Aceptada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelacion()
    {
        return $this->hasOne(Relaciones::className(), ['id' => 'relacion_id']);
    }

    public function isHistorialSaved()
    {
        return false;
    }

    public function getNotificacionContenido()
    {
        return $this->seguidor->username . ' ha solicitado una relacion con uno de tus personajes.';
    }

    public function getNotificacionUrl()
    {
        return $this->seguidor->getRawUrl();
    }
}
