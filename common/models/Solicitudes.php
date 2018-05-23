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
class Solicitudes extends \yii\db\ActiveRecord
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
}
