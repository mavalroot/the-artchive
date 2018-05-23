<?php

namespace common\models;

use Yii;

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
            [['relacion_id', 'usuario_id'], 'required'],
            [['relacion_id'], 'default', 'value' => null],
            [['relacion_id'], 'integer'],
            [['aceptada'], 'boolean'],
            [['aceptada'], 'default', 'value' => false],
            [['relacion_id'], 'unique'],
            [['relacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Relaciones::className(), 'targetAttribute' => ['relacion_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }

    public function getNotificacionTipo()
    {
        $nombre = 'relaciones';
        $tipo = TiposNotificaciones::findOne(['tipo' => $nombre]);
        return $tipo->id;
    }

    public function isHistorialSaved()
    {
        return false;
    }

    public function getNotificacionContenido()
    {
        $personaje = Personajes::find($this->getRelacion()->one()->referencia)->one();
        return 'Se ha solicitado crear una relación con' . $personaje->nombre;
    }

    public function getNotificacionUrl()
    {
        return $this->getRawUrl();
    }
}
