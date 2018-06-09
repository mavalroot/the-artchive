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
class Solicitudes extends \common\utilities\ArtchiveBase
{
    use \common\utilities\Notificacion;
    use \common\utilities\Creator;


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
            [['usuario_id'], 'required',
                'message' => Yii::t('app', 'Campo requerido.'),
            ],
            [['relacion_id'], 'default', 'value' => null],
            [['relacion_id'], 'integer',
                'message' => Yii::t('app', 'Debe ser un número entero.')
            ],
            [['aceptada'], 'boolean'],
            [['aceptada'], 'default', 'value' => false],
            [['respondida'], 'boolean'],
            [['respondida'], 'default', 'value' => false],
            [['relacion_id'], 'unique'],
            [['relacion_id'], 'exist', 'skipOnError' => true,
                'skipOnEmpty' => true,
                'targetClass' => Relaciones::className(),
                'targetAttribute' => ['relacion_id' => 'id'],
                'message' => Yii::t('app', 'La relación no existe'),
            ],
            [['usuario_id'], 'exist', 'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['usuario_id' => 'id'],
                'message' => Yii::t('app', 'El usuario no existe.'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'aceptada' => Yii::t('app', 'Ha sido aceptada'),
            'respondida' => Yii::t('app', 'Ha sido respondida'),
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

    /**
     * Devuelve los botones de la solicitud (aceptar y rechazar)
     * @return string
     */
    public function getButtons()
    {
        if (!$this->respondida && $this->relacion_id) {
            return Html::a(Yii::t('app', 'Aceptar'), ['aceptar', 'id' => $this->id], [
                'class' => 'btn btn-sm btn-success',
                'data' => [
                    'method' => 'post',
                ],
            ]) .
            Html::a(Yii::t('app', 'Rechazar'), ['rechazar', 'id' => $this->id], [
                'class' => 'btn btn-sm btn-danger',
                'data' => [
                    'method' => 'post',
                ],
            ]);
        }
        return;
    }

    /**
     * Responde a una solicitud.
     * @param  bool $bool Falso si la respuesta es rechazar y verdadero si es
     * aceptar.
     * @return bool
     */
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

    public function afterSave($insert, $changedAttributes)
    {
        if (!parent::afterSave($insert, $changedAttributes)) {
            return false;
        }

        if ($insert) {
            $this->crearNotificacion([
                'url' => $this->getRawUrl(),
            ]);
        }
        return true;
    }

    /**
     * Devuelve el mensaje de la solicitud
     * @return string
     */
    public function getMensajeSolicitud()
    {
        $relacion = $this->relacion;
        if (!isset($relacion)) {
            return Yii::t('frontend', 'Esta relación ha sido eliminada.');
        }
        $referencia = Personajes::findOne($relacion->referencia);
        $personaje = Personajes::findOne($relacion->personaje_id);
        $user = User::findOne($personaje->usuario_id);
        $tipo = TiposRelaciones::findOne($relacion->tipo_relacion_id);
        $tipo = Yii::$app->language == 'es-ES' ? $tipo->tipo_es : $tipo->tipo_en;
        return Yii::t('app', 'Se solicita confirmación de que') .
        " <b>$referencia->nombre</b> " . Yii::t('app', '(tu personaje) es') .
        ' ' . $tipo . ' ' . Yii::t('app', 'de') . ' ' .
        "<b>$personaje->nombre</b>" . ' ' .
        Yii::t('app', '(personaje de') . ' ' . $user->getUrl() . ').';
    }

    /**
     * Devuelve el título de la solicitud.
     * @return string
     */
    public function getTituloSolicitud()
    {
        return Yii::t('app', 'Solicitud de relación');
    }
}
