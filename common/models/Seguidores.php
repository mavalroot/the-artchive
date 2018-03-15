<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "seguidores".
 *
 * @property int $id
 * @property int $user_id
 * @property int $seguidor_id
 *
 * @property User $user
 * @property User $seguidor
 */
class Seguidores extends \yii\db\ActiveRecord
{
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
            [['user_id', 'seguidor_id'], 'required'],
            [['user_id', 'seguidor_id'], 'default', 'value' => null],
            [['user_id', 'seguidor_id'], 'integer'],
            [['user_id', 'seguidor_id'], 'unique', 'targetAttribute' => ['user_id', 'seguidor_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['seguidor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['seguidor_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'seguidor_id' => 'Seguidor ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeguidor()
    {
        return $this->hasOne(User::className(), ['id' => 'seguidor_id']);
    }
}
