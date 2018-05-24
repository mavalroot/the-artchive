<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipos_relaciones".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property Relaciones[] $relaciones
 */
class TiposRelaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipos_relaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 255],
            [['tipo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelaciones()
    {
        return $this->hasMany(Relaciones::className(), ['tipo_relacion_id' => 'id']);
    }
}