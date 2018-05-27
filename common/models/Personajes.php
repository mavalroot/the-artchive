<?php

namespace common\models;

use Yii;

use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * This is the model class for table "personajes".
 *
 * @property int $id
 * @property int $usuario_id
 * @property string $nombre
 * @property string $fecha_nac
 * @property string $historia
 * @property string $personalidad
 * @property string $apariencia
 * @property string $hechos_destacables
 * @property string $created_at
 * @property string $updated_at
 *
 * @property EsCreador[] $esCreador
 * @property EsFamiliar[] $esFamiliar
 * @property User $usuario
 */
class Personajes extends \common\utilities\ArtchiveBase
{
    /**
     * Creador del personaje
     * @var string
     */
    public $creator;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personajes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id', 'nombre'], 'required', 'message' => Yii::t('app', 'Campo requerido.')],
            [['usuario_id'], 'integer', 'message' => Yii::t('app', 'Debe ser un número entero.')],
            [['fecha_nac', 'created_at', 'updated_at'], 'safe'],
            [['historia', 'personalidad', 'apariencia', 'hechos_destacables'], 'string'],
            [['nombre'], 'string', 'max' => 255,
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
            'nombre' => Yii::t('app', 'Nombre'),
            'fecha_nac' => Yii::t('app', 'Fecha de nacimiento'),
            'historia' => Yii::t('app', 'Historia'),
            'personalidad' => Yii::t('app', 'Personalidad'),
            'apariencia' => Yii::t('app', 'Apariencia'),
            'hechos_destacables' => Yii::t('app', 'Hechos destacables'),
            'created_at' => Yii::t('app', 'Fecha de creación'),
            'updated_at' => Yii::t('app', 'Última actualización'),
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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsCreador()
    {
        return $this->hasMany(Relaciones::className(), ['propietario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsFamiliar()
    {
        return $this->hasMany(Relaciones::className(), ['familiar_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }

    public function getDataName()
    {
        return 'nombre';
    }

    /**
     * Muestra los botones de Modificar y borrar si el usuario conectado es el
     * propietario del personaje.
     */
    public function getButtons()
    {
        if ($this->isMine()) {
            $botones =
            Html::a(Yii::t('app', 'Modificar'), ['update', 'id' => $this->id], ['class' => 'btn btn-sm btn-success']) .
            Html::a(Yii::t('app', 'Borrar'), ['delete', 'id' => $this->id], [
                'class' => 'btn btn-sm btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', '¿Seguro que desea borrar el personaje? No podrá ser recuperado.'),
                    'method' => 'post',
                ],
            ]);
            return $botones;
        }
    }
}
