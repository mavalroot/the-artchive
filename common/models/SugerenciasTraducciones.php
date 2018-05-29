<?php

namespace common\models;

use Yii;

use yii\db\Expression;
use yii\db\ActiveRecord;

use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "sugerencias_traducciones".
 *
 * @property int $id
 * @property string $contenido
 * @property string $referencia
 * @property string $estado
 * @property string $respuesta
 * @property int $created_by
 * @property string $created_at
 *
 * @property User $createdBy
 */
class SugerenciasTraducciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sugerencias_traducciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contenido', 'referencia', 'created_by'], 'required'],
            [['contenido'], 'string'],
            [['created_by'], 'default', 'value' => null],
            [['created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['referencia', 'estado', 'respuesta'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'contenido' => Yii::t('app', 'Contenido'),
            'referencia' => Yii::t('app', 'Referencia'),
            'estado' => Yii::t('app', 'Estado'),
            'respuesta' => Yii::t('app', 'Respuesta'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'value' => new Expression('NOW()'),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
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
