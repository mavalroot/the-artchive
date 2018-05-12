<?php

namespace common\models;

use Yii;

use yii\db\Expression;
use yii\db\ActiveRecord;

use yii\helpers\Html;

/**
 * This is the model class for table "mensajes_privados".
 *
 * @property int $id
 * @property int $emisor_id
 * @property int $receptor_id
 * @property string $asunto
 * @property string $contenido
 * @property bool $leido
 * @property bool $del_e
 * @property bool $del_r
 * @property string $created_at
 * @property string $emisor_name
 * @property string $receptor_name
 *
 * @property User $emisor
 * @property User $receptor
 *
 */
class MensajesPrivados extends \common\utilities\BaseNotis
{
    public $emisor_name;
    public $receptor_name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mensajes_privados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emisor_id', 'receptor_id', 'asunto', 'contenido'], 'required'],
            [['emisor_id', 'receptor_id'], 'default', 'value' => null],
            [['emisor_id', 'receptor_id'], 'integer'],
            [['contenido'], 'string'],
            [['leido', 'del_e', 'del_r'], 'boolean'],
            [['created_at', 'receptor_name', 'emisor_name'], 'safe'],
            [['asunto'], 'string', 'max' => 255],
            [['emisor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['emisor_id' => 'id']],
            [['receptor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receptor_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'emisor_id' => 'Emisor ID',
            'receptor_id' => 'Receptor ID',
            'asunto' => 'Asunto',
            'contenido' => 'Contenido',
            'leido' => 'Leido',
            'created_at' => 'Fecha de envío',
            'emisor_name' => 'Emisor',
            'receptor_name' => 'Receptor',
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
    public function getEmisor()
    {
        return $this->hasOne(User::className(), ['id' => 'emisor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceptor()
    {
        return $this->hasOne(User::className(), ['id' => 'receptor_id']);
    }

    /**
     * Indica si el usuario conectado es el emisor de este mensaje.
     * @return bool
     */
    public function imEmisor()
    {
        return $this->getEmisor()->one()->id == Yii::$app->user->id;
    }

    /**
     * Indica si el usuario conectado es el receptor de este mensaje.
     * @return bool
     */
    public function imReceptor()
    {
        return $this->getReceptor()->one()->id == Yii::$app->user->id;
    }

    public function isHistorialSaved()
    {
        return false;
    }

    public function getUnName()
    {
        return 'un mensaje privado';
    }

    public function getNotificacionReceptor()
    {
        return $this->receptor_id;
    }
}
