<?php

namespace common\models;

use Yii;

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
 * @property Personajes $referencia0
 * @property TiposRelaciones $tipoRelacion
 * @property Solicitudes $solicitudes
 */
class Relaciones extends \yii\db\ActiveRecord
{
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
            [['referencia', 'tipo_relacion_id', 'personaje_id'], 'unique', 'targetAttribute' => ['referencia', 'tipo_relacion_id', 'personaje_id'], 'message' => 'Esta relación ya existe.'],
            [['personaje_id', 'tipo_relacion_id'], 'required'],
            [['personaje_id', 'referencia', 'tipo_relacion_id'], 'default', 'value' => null],
            [['personaje_id', 'referencia', 'tipo_relacion_id'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['personaje_id'], 'exist', 'skipOnError' => true, 'targetClass' => Personajes::className(), 'targetAttribute' => ['personaje_id' => 'id']],
            [['referencia'], 'exist', 'skipOnError' => true, 'targetClass' => Personajes::className(), 'targetAttribute' => ['referencia' => 'id']],
            [['tipo_relacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => TiposRelaciones::className(), 'targetAttribute' => ['tipo_relacion_id' => 'id']],
        ];
    }

    public function validateReferencia($attribute)
    {
        if ($this->$attribute == $this->personaje_id) {
            $this->addError($attribute, '¡No puedes seleccionarte a ti mismo!');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'personaje_id' => 'Personaje ID',
            'nombre' => 'Personaje anónimo',
            'referencia' => 'Personaje existente',
            'tipo_relacion_id' => 'Tipo de relación',
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
    public function getReferencia0()
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

    public function enviarSolicitud()
    {
        if ($this->referencia) {
            $personaje = Personajes::findOne($this->referencia);
            if ($personaje->usuario_id != Yii::$app->user->id) {
                $solicitud = new Solicitudes();
                $solicitud->relacion_id = $this->id;
                $solicitud->usuario_id = $personaje->usuario_id;
                $solicitud->mensaje = $this->mensajeSolicitud();
                $solicitud->nombre = 'Se ha solicitado crear una relación con ' . $personaje->nombre . '.';
                return $solicitud->save();
            }
        }
        return false;
    }

    public function mensajeSolicitud()
    {
        $referencia = Personajes::findOne($this->referencia);
        $personaje = Personajes::findOne($this->personaje_id);
        $user = User::findOne($personaje->usuario_id);
        $relacion = TiposRelaciones::findOne($this->tipo_relacion_id);
        return "Se solicita confirmación de que <b>$referencia->nombre</b> (tu personaje) es $relacion->tipo de <b>$personaje->nombre</b> (personaje de " . $user->getUrl() . ').';
    }
}
