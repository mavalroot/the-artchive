<?php

namespace common\models;

use Yii;

use yii\helpers\Url;
use yii\helpers\Html;

/**
 * This is the model class for table "comentarios".
 *
 * @property int $id
 * @property int $usuario_id
 * @property int $publicacion_id
 * @property string $contenido
 * @property int $comentario_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Comentarios $comentario
 * @property Comentarios[] $comentarios
 * @property Publicaciones $publicacion
 * @property User $usuario
 */
class Comentarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'publicacion_id', 'contenido'], 'required'],
            [['usuario_id', 'publicacion_id', 'comentario_id'], 'default', 'value' => null],
            [['usuario_id', 'publicacion_id', 'comentario_id'], 'integer'],
            [['contenido'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['comentario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comentarios::className(), 'targetAttribute' => ['comentario_id' => 'id']],
            [['publicacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Publicaciones::className(), 'targetAttribute' => ['publicacion_id' => 'id']],
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
            'usuario_id' => 'Usuario ID',
            'publicacion_id' => 'Publicacion ID',
            'contenido' => 'Contenido',
            'comentario_id' => 'Comentario ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentario()
    {
        return $this->hasOne(Comentarios::className(), ['id' => 'comentario_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::className(), ['comentario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacion()
    {
        return $this->hasOne(Publicaciones::className(), ['id' => 'publicacion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }

    public function getUsername()
    {
        $user = $this->getUsuario()->one()->username;
        return Html::a($user, ['usuarios-completo/view', 'username' => $user]);
    }

    public function getPermalink()
    {
        return Html::a('#' . $this->id, [Url::to(), '#' => 'com' . $this->id]);
    }

    public function isQuote()
    {
        return $this->getComentario()->one() !== null;
    }

    public function getRespuestaUrl()
    {
        if ($this->isQuote()) {
            return $this->getComentario()->one()->getPermalink();
        }
    }
}