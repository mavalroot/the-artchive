<?php

namespace common\models;

use Yii;

use yii\helpers\Html;

/**
 * This is the model class for table "relaciones".
 *
 * @property int $id
 * @property int $personaje_id
 * @property string $nombre
 * @property int $referencia
 * @property int $tipo_relacion_id
 *
 * @property Personajes $personaje
 * @property Personajes $referencia
 * @property TiposRelaciones $tipoRelacion
 * @property Solicitudes $solicitudes
 */
class Relaciones extends \yii\db\ActiveRecord
{
    /**
     * Personaje que creó la relación.
     * @var string
     */
    public $mipj;

    /**
     * Id del personaje que creó la relación.
     * @var int
     */
    public $mipjid;

    /**
     * Personaje de la referencia.
     * @var string
     */
    public $supj;

    /**
     * Id del personaje de la referencia.
     * @var int
     */
    public $supjid;

    /**
     * Relación que mantienen.
     * @var string
     */
    public $relacion;

    /**
     * Estado de la relación (aceptada o no).
     * @var bool
     */
    public $aceptada;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'relaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['referencia', 'validateReferencia'],
            ['referencia', 'validateRequired', 'skipOnEmpty' => false],
            ['nombre', 'validateRequired', 'skipOnEmpty' => false],
            ['referencia', 'validateOneOrAnother', 'skipOnEmpty' => false],
            ['nombre', 'validateOneOrAnother', 'skipOnEmpty' => false],
            [['referencia', 'tipo_relacion_id', 'personaje_id'], 'unique',
                'when' => function ($model) {
                    return $model->referencia != null;
                }, 'targetAttribute' => ['referencia', 'tipo_relacion_id', 'personaje_id'],
                'message' => Yii::t('app', 'Esta relación ya existe.')
            ],
            [['personaje_id', 'tipo_relacion_id'], 'required'],
            [['personaje_id', 'referencia', 'tipo_relacion_id'], 'default', 'value' => null],
            [['personaje_id', 'referencia', 'tipo_relacion_id'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['personaje_id'], 'exist', 'skipOnError' => true, 'targetClass' => Personajes::className(), 'targetAttribute' => ['personaje_id' => 'id']],
            [['referencia'], 'exist', 'skipOnError' => true, 'targetClass' => Personajes::className(), 'targetAttribute' => ['referencia' => 'id']],
            [['tipo_relacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => TiposRelaciones::className(), 'targetAttribute' => ['tipo_relacion_id' => 'id']],
        ];
    }

    /**
     * Valida que el personaje de la referencia no pueda ser el mismo.
     * @param  string $attribute
     */
    public function validateReferencia($attribute)
    {
        if ($this->$attribute == $this->personaje_id) {
            $this->addError($attribute, Yii::t('app', '¡No puedes seleccionar a tu mismo personaje!'));
        }
    }

    /**
     * Valida que los dos campos a la vez no pueden estar vacíos.
     */
    public function validateRequired()
    {
        if ($this->referencia == '' && $this->nombre == '') {
            $this->addError('referencia', Yii::t('app', '¡Uno de los dos campos debe estar relleno!'));
            $this->addError('nombre', Yii::t('app', '¡Uno de los dos campos debe estar relleno!'));
        }
    }

    /**
     * Valida que referencia y nombre no puedan estar rellenos a la vez.
     */
    public function validateOneOrAnother()
    {
        if ($this->referencia && $this->nombre) {
            $this->addError('referencia', Yii::t('app', '¡Sólo puedes elegir uno a la vez!'));
            $this->addError('nombre', Yii::t('app', '¡Sólo puedes elegir uno a la vez!'));
        }
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nombre' => Yii::t('app', 'Personaje anónimo'),
            'referencia' => Yii::t('app', 'Personaje existente'),
            'tipo_relacion_id' => Yii::t('app', 'Tipo de relación'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaje()
    {
        return $this->hasOne(Personajes::className(), ['id' => 'personaje_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferencia()
    {
        return $this->hasOne(Personajes::className(), ['id' => 'referencia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoRelacion()
    {
        return $this->hasOne(TiposRelaciones::className(), ['id' => 'tipo_relacion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudes()
    {
        return $this->hasOne(Solicitudes::className(), ['relacion_id' => 'id']);
    }

    /**
     * Crea una solicitud.
     * @return bool
     */
    public function enviarSolicitud()
    {
        if ($this->referencia) {
            $personaje = Personajes::findOne($this->referencia);
            if ($personaje->usuario_id != Yii::$app->user->id) {
                $solicitud = new Solicitudes();
                $solicitud->relacion_id = $this->id;
                $solicitud->usuario_id = $personaje->usuario_id;
                return $solicitud->save();
            }
        }
        return false;
    }

    /**
     * Devuelve el botón para eliminar.
     * @return string
     */
    public function getDeleteButton()
    {
        return Html::beginForm('', 'post', ['name' => 'delete-relation']) .
        Html::hiddenInput('id', $this->id) .
        Html::submitButton(Yii::t('app', 'Borrar'), ['class' => 'btn btn-xs btn-primary']) .
        Html::endForm();
    }
}
