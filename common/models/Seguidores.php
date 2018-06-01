<?php

namespace common\models;

/**
 * This is the model class for table "seguidores".
 *
 * @property int $id
 * @property int $usuario_id
 * @property int $seguidor_id
 *
 * @property User $user
 * @property User $seguidor
 */
class Seguidores extends \common\utilities\ArtchiveBase
{
    use \common\utilities\Notificacion;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seguidores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id', 'seguidor_id'], 'required'],
            [['usuario_id', 'seguidor_id'], 'default', 'value' => null],
            [['usuario_id', 'seguidor_id'], 'integer'],
            [['usuario_id', 'seguidor_id'], 'unique', 'targetAttribute' => ['usuario_id', 'seguidor_id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
            [['seguidor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['seguidor_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeguidor()
    {
        return $this->hasOne(User::className(), ['id' => 'seguidor_id']);
    }

    public function isHistorialSaved()
    {
        return false;
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->crearNotificacion([
                'url' => $this->seguidor->getRawUrl(),
                'user' => $this->usuario_id,
            ]);
        }
        return true;
    }
}
