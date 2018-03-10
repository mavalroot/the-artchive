<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipos_usuario".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property UsuariosDatos[] $usuariosDatos
 */
class TiposUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipos_usuario';
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
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
    public function getUsuariosDatos()
    {
        return $this->hasMany(UsuariosDatos::className(), ['tipo_usuario' => 'id']);
    }
}
