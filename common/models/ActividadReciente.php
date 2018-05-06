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
            'mensaje' => 'Acción',
            'url' => 'Url',
            'created_at' => 'Fecha',
            'created_by' => 'Created By',
            'creator' => 'Usuario',
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
    public function GetUrlCreator()
    {
        return Html::a($this->createdBy->username, ['/usuarios-completo/view', 'username' => $this->createdBy->username]);
    }
}
