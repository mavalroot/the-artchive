<?php

namespace common\models;

use Yii;

use yii\helpers\Html;

/**
 * This is the model class for table "solicitudes".
 *
 * @property int $id
 * @property int $relacion_id
 * @property bool $aceptada
 *
 * @property Relaciones $relacion
 */
class Solicitudes extends \common\utilities\BaseNotis
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'solicitudes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mensaje', 'usuario_id'], 'required'],
            [['relacion_id'], 'default', 'value' => null],
            [['relacion_id'], 'integer'],
            [['aceptada'], 'boolean'],
            [['aceptada'], 'default', 'value' => false],
            [['respondida'], 'boolean'],
            [['respondida'], 'default', 'value' => false],
            [['relacion_id'], 'unique'],
            [['relacion_id'], 'exist', 'skipOnError' => true, 'skipOnEmpty' => true, 'targetClass' => Relaciones::className(), 'targetAttribute' => ['relacion_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'relacion_id' => 'Relacion ID',
            'aceptada' => 'Ha sido aceptada',
            'respondida' => 'Ha sido respondida',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelacion()
    {
        return $this->hasOne(Relaciones::className(), ['id' => 'relacion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }

    public function getNotificacionTipo()
    {
        $nombre = 'relaciones';
        $tipo = TiposNotificaciones::findOne(['tipo' => $nombre]);
        return $tipo->id;
    }

    public function isHistorialSaved()
    {
        return false;
    }

    public function getNotificacionUrl()
    {
        return $this->getRawUrl();
    }

    public function getNotificacionContenido()
    {
        return $this->nombre;
    }

    public function getButtons()
    {
        if (!$this->respondida) {
            return Html::a('Aceptar', ['aceptar', 'id' => $this->id], [
                'class' => 'btn btn-sm btn-success',
                'data' => [
                    'confirm' => '¿Seguro que desea borrar el personaje? No podrá ser recuperado.',
                    'method' => 'post',
                ],
            ]) .
            Html::a('Rechazar', ['rechazar', 'id' => $this->id], [
                'class' => 'btn btn-sm btn-danger',
                'data' => [
                    'confirm' => '¿Seguro que desea borrar el personaje? No podrá ser recuperado.',
                    'method' => 'post',
                ],
            ]);
        }
        return;
    }

    public function responder($bool)
    {
        if ($bool) {
            $this->aceptada = true;
        } else {
            $this->relacion_id = null;
        }
        $this->respondida = true;
        return $this->update();
    }
}
