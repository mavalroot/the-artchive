<?php

namespace common\models;

use Yii;

use yii\helpers\Html;

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
     * Creador de la actividad
     * @var string
     */
    public $creator;

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
            [['mensaje', 'created_by'], 'required',
                'message' => Yii::t('app', 'Campo requerido.')
            ],
            [['created_at'], 'safe'],
            [['created_by'], 'default', 'value' => null],
            [['created_by'], 'integer',
                'message' => Yii::t('app', 'Debe ser un número entero.')
            ],
            [['mensaje', 'url'], 'string', 'max' => 255,
                'message' => Yii::t('app', 'No puede superar los 255 carácteres.')
            ],
            [['created_by'], 'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['created_by' => 'id'],
                'message' => Yii::t('app', 'El usuario no existe.')
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mensaje' => Yii::t('app', 'Acción'),
            'url' => 'Url',
            'created_at' => Yii::t('app', 'Fecha'),
            'created_by' => Yii::t('app', 'Creado por'),
            'creator' => Yii::t('app', 'Creador'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Muestra el creador del personaje como un link
     * @return string
     */
    public function getUrlCreator()
    {
        return Html::a($this->createdBy->username, ['/usuarios-completo/view', 'username' => $this->createdBy->username]);
    }
}
