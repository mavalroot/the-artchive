<?php

namespace common\models;

use Yii;

use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "mensajes_privados".
 *
 * @property int $id
 * @property int $emisor_id
 * @property int $receptor_id
 * @property string $asunto
 * @property string $contenido
 * @property bool $seen
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
class MensajesPrivados extends \common\utilities\ArtchiveBase
{
    /**
     * Nombre del emisor.
     * @var string
     */
    public $emisor_name;

    /**
     * Nombre del receptor
     * @var string
     */
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
            [['emisor_id', 'receptor_id', 'asunto', 'contenido'], 'required',
                'message' => Yii::t('app', 'Campo requerido.')
            ],
            [['emisor_id', 'receptor_id'], 'default', 'value' => null],
            [['emisor_id', 'receptor_id'], 'integer',
                'message' => Yii::t('app', 'Debe ser un número entero.')
            ],
            [['contenido', 'receptor_name', 'emisor_name'], 'string'],
            [['seen', 'del_e', 'del_r'], 'boolean'],
            [['created_at'], 'safe'],
            [['asunto'], 'string', 'max' => 255,
                'message' => Yii::t('app', 'No puede superar los 255 carácteres.')
            ],
            [['emisor_name'], 'exist', 'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['emisor_name' => 'username'],
                'message' => Yii::t('app', 'El usuario no existe.')
            ],
            [['receptor_name'], 'exist', 'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['receptor_name' => 'username'],
                'message' => Yii::t('app', 'El usuario no existe.')
            ],
            [['emisor_id'], 'exist', 'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['emisor_id' => 'id'],
                'message' => Yii::t('app', 'El usuario no existe.')
            ],
            [['receptor_id'], 'exist', 'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['receptor_id' => 'id'],
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
            'asunto' => Yii::t('app', 'Asunto'),
            'contenido' => Yii::t('app', 'Contenido'),
            'seen' => Yii::t('app', 'Visto'),
            'created_at' => Yii::t('app', 'Fecha de envío'),
            'emisor_name' => Yii::t('app', 'Emisor'),
            'receptor_name' => Yii::t('app', 'Receptor'),
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

    public function getDataName()
    {
        return 'asunto';
    }
}
