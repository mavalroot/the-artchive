<?php

namespace common\models;

use Yii;

use yii\db\Expression;
use yii\db\ActiveRecord;

use yii\helpers\Url;
use yii\helpers\Html;

use common\utilities\Historial;

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
class Personajes extends \yii\db\ActiveRecord
{
    use Historial;
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
            [['usuario_id', 'nombre'], 'required'],
            // [['usuario_id'], 'default', 'value' => null],
            [['usuario_id'], 'integer'],
            [['fecha_nac', 'created_at', 'updated_at'], 'safe'],
            [['historia', 'personalidad', 'apariencia', 'hechos_destacables'], 'string'],
            [['nombre'], 'string', 'max' => 255],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'nombre' => 'Nombre',
            'fecha_nac' => 'Fecha de nacimiento',
            'historia' => 'Historia',
            'personalidad' => 'Personalidad',
            'apariencia' => 'Apariencia',
            'hechos_destacables' => 'Hechos destacables',
            'created_at' => 'Fecha de creación',
            'updated_at' => 'Última actualización',
            'creator' => 'Creado por'
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
        return $this->hasMany(Parentescos::className(), ['propietario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsFamiliar()
    {
        return $this->hasMany(Parentescos::className(), ['familiar_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }

    /**
     * Devuelve un array con la url del view de ese personaje.
     * @return array
     */
    public function getUrl()
    {
        return Html::a($this->nombre, ['personajes/view', 'id' => $this->id]);
    }

    /**
     * Indica si el usuario conectado es el propietario del personaje.
     * @return bool
     */
    public function isMine()
    {
        return $this->usuario_id == Yii::$app->user->id;
    }

    /**
     * Muestra los botones de Modificar y borrar si el usuario conectado es el
     * propietario del personaje.
     */
    public function getButtons()
    {
        if ($this->isMine()) {
            $botones =
            Html::a('Modificar', ['update', 'id' => $this->id], ['class' => 'btn btn-sm btn-success']) .
            Html::a('Borrar', ['delete', 'id' => $this->id], [
                'class' => 'btn btn-sm btn-danger',
                'data' => [
                    'confirm' => '¿Seguro que desea borrar el personaje? No podrá ser recuperado.',
                    'method' => 'post',
                ],
            ]);
            return $botones;
        }
    }

    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }

    /**
     * Muestra el creador del personaje como un link
     * @return string
     */
    public function GetUrlCreator()
    {
        return Html::a($this->creator, ['/usuarios-completo/view', 'username' => $this->creator]);
    }

    /**
     * Muestra el botón para exportar a pdf.
     * @return string
     */
    public function getExportButton()
    {
        if ($this->isMine()) {
            return Html::button('Guardar como pdf', ['id' => 'export', 'data-name' => $this->nombre, 'class' => 'btn btn-sm btn-primary']);
        }
    }

    public function getHistorialUrl()
    {
        return Url::to(['personajes/view', 'id' => $this->id]);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            Historial::crearHistorial('Ha creado un personaje', $this->getHistorialUrl());
        } else {
            Historial::crearHistorial('Ha modificado un personaje', $this->getHistorialUrl());
        }
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }
        Historial::crearHistorial('Ha borrado su personaje', false);
        return true;
    }
}
