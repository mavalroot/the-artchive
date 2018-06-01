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
    use \common\utilities\Mensajes;
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
            [['usuario_id'], 'required', 'message' => Yii::t('app', 'Campo requerido.')],
            [['usuario_id'], 'default', 'value' => null],
            [['usuario_id'], 'integer',
                'message' => Yii::t('app', 'Debe ser un número entero.')
            ],
            [['seen'], 'boolean'],
            [['notificacion'], 'string', 'max' => 255,
                'message' => Yii::t('app', 'No puede superar los 255 carácteres.')
            ],
            [['usuario_id'], 'exist', 'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['usuario_id' => 'id'],
                'message' => Yii::t('app', 'El usuario no existe.')
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'notificacion' => Yii::t('app', 'Notificación'),
            'created_at' => Yii::t('app', 'Recibido'),
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
