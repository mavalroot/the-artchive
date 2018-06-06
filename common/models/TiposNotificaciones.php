<?php

namespace common\models;

/**
 * This is the model class for table "tipos_notificaciones".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property Notificaciones[] $notificaciones
 */
class TiposNotificaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipos_notificaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required', 'message'],
            [['tipo'], 'string', 'max' => 255],
            [['tipo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificaciones()
    {
        return $this->hasMany(Notificaciones::className(), ['tipo_notificacion_id' => 'id']);
    }

    /**
     * Devuelve el id del tipo de notificación.
     * @param  string $tipo
     * @return int|null
     */
    public static function getNotificacionId($tipo)
    {
        if ($tipoNoti = TiposNotificaciones::findOne(['tipo' => $tipo])) {
            return $tipoNoti->id;
        }
        return null;
    }

    /**
     * Devuelve el mensaje de la notificación.
     * @return mixed
     */
    public function getMessage()
    {
        return $model->mensajesDeNotificacion([
            'tipo' => $model->tipo_notificacion_id,
        ]);
    }
}
