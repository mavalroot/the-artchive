<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bloqueos".
 *
 * @property int $id
 * @property int $usuario_id
 * @property int $bloqueado_id
 *
 * @property User $usuario
 * @property User $bloqueado
 */
class Bloqueos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bloqueos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'bloqueado_id'], 'required'],
            [['usuario_id', 'bloqueado_id'], 'default', 'value' => null],
            [['usuario_id', 'bloqueado_id'], 'integer'],
            [['usuario_id', 'bloqueado_id'], 'unique', 'targetAttribute' => ['usuario_id', 'bloqueado_id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
            [['bloqueado_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['bloqueado_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'bloqueado_id' => 'Bloqueado ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBloqueado()
    {
        return $this->hasOne(User::className(), ['id' => 'bloqueado_id']);
    }
}
