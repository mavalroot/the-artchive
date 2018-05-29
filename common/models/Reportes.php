<?php

namespace common\models;

use Yii;

use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "reportes".
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
class Reportes extends \common\utilities\ArtchiveBase
{
    /**
     * Creador de la sugerencia.
     * @var string
     */
    public $creator;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reportes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contenido', 'referencia', 'created_by', 'tipo'], 'required'],
            [['contenido'], 'string'],
            [['created_by'], 'default', 'value' => null],
            [['created_by'], 'integer'],
            [['created_at', 'creator'], 'safe'],
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
            'id' => 'ID',
            'contenido' => Yii::t('app', 'Contenido'),
            'referencia' => Yii::t('app', 'Asunto'),
            'estado' => Yii::t('app', 'Estado'),
            'respuesta' => Yii::t('app', 'Respuesta'),
            'created_by' => Yii::t('app', 'Creador'),
            'created_at' => Yii::t('app', 'Fecha de creación'),
            'creator' => Yii::t('app', 'Creador'),
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

    public function getDataName()
    {
        return 'referencia';
    }

    public function getTipos()
    {
        return [
            'General' => 'General',
            'Problema técnico' => 'Problema técnico',
            'Error de traducción' => 'Traducción',
            'Otras' => 'Otras',
        ];
    }

    public function getEstados()
    {
        return [
            'En revisión' => 'En revisión',
            'Aceptado' => 'Aceptado',
            'Rechazado' => 'Rechazado',
            'Solucionado' => 'Solucionado',
        ];
    }

    public function getUnName()
    {
        return Yii::t('app', 'un reporte');
    }

    public function getNotificacionReceptor()
    {
        return $this->created_by;
    }
}
