<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notificaciones".
 *
 * @property int $id
 * @property int $usuario_id
 * @property string $notificacion
 * @property boolean $seen
 *
 * @property User $user
 */
class Notificaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notificaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id', 'created_by'], 'required', 'message' => Yii::t('app', 'Campo requerido.')],
            [['usuario_id'], 'default', 'value' => null],
            [['usuario_id'], 'integer',
                'message' => Yii::t('app', 'Debe ser un número entero.')
            ],
            [['seen'], 'boolean'],
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
            'notificacion' => Yii::t('app', 'Notificación'),
            'created_at' => Yii::t('app', 'Recibido'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }

    /**
     * Mensajes de notificación (traducibles).
     * @param  string $tipo Tipo de la notificación.
     * @return string       Mensaje listo para mostrar.
     */
    public function mensajesDeNotificacion($tipo)
    {
        $mensaje = '';
        $delante = '';
        $detras = '';
        switch ($tipo) {
            case TiposNotificaciones::getNotificacionId('mensajes privados'):
                $mensaje = Yii::t('app', 'Has recibido un mensaje privado de');
                $detras = $this->mensajeDeNotificacionEmisor();
                break;
            case TiposNotificaciones::getNotificacionId('comentarios'):
                $mensaje = Yii::t('app', 'ha comentado tu publicación');
                $delante = $this->mensajeDeNotificacionEmisor() . ' ';
                break;
            case TiposNotificaciones::getNotificacionId('relaciones'):
                $mensaje = Yii::t('app', 'Has recibido una solicitud para crear una relación');
                break;
            case TiposNotificaciones::getNotificacionId('seguidores'):
                $mensaje = Yii::t('app', 'ha comenzado a seguirte');
                $delante = $this->mensajeDeNotificacionEmisor() . ' ';
                break;
            default:
                $mensaje = Yii::t('app', 'Has recibido una notificación');
                break;
        }

        return $delante . $mensaje . $detras . '.';
    }

    /**
     * Devuelve el emisor de la notificación.
     * @return User
     */
    private function mensajeDeNotificacionEmisor()
    {
        return User::findOne($this->created_by)->username;
    }
}
