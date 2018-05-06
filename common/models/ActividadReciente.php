<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "actividad_reciente".
 *
 * @property int $id
 * @property string $mensaje
 * @property string $url
 * @property string $created_at
 * @property int $created_by
 *
 * @property User $createdBy
 */
class ActividadReciente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'actividad_reciente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mensaje', 'created_by'], 'required'],
            [['created_at'], 'safe'],
            [['created_by'], 'default', 'value' => null],
            [['created_by'], 'integer'],
            [['mensaje', 'url'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mensaje' => 'Mensaje',
            'url' => 'Url',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
