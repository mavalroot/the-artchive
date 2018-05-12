<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notificaciones".
 *
 * @property int $id
 * @property int $usuario_id
 * @property string $notificacion
 * @property boolean $seen
 *
 * @property User $user
 */
class Notificaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notificaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id'], 'required'],
            [['usuario_id'], 'default', 'value' => null],
            [['usuario_id'], 'integer'],
            [['seen'], 'boolean'],
            [['notificacion'], 'string', 'max' => 255],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'User ID',
            'notificacion' => 'Notificacion',
            'created_at' => 'Recibido'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }
}
