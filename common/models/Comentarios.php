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
class Comentarios extends \common\utilities\BaseNotis
{
    /**
     * Indica si ha sido citado.
     * @var bool
     */
    public $quoted;
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
            [['usuario_id', 'publicacion_id', 'contenido'], 'required',
                'message' => Yii::t('app', 'Campo requerido.')
            ],
            [['usuario_id', 'publicacion_id', 'comentario_id'], 'default', 'value' => null],
            [['deleted'], 'default', 'value' => false],
            ['deleted', 'boolean'],
            [['usuario_id', 'publicacion_id', 'comentario_id'], 'integer',
                'message' => Yii::t('app', 'Debe ser un número entero.')
            ],
            [['contenido'], 'string', 'max' => 500,
                'message' => Yii::t('app', 'No puede superar los 255 carácteres.')
            ],
            [['created_at', 'updated_at'], 'safe'],
            [['comentario_id'], 'exist', 'skipOnError' => true,
                'targetClass' => Comentarios::className(),
                'targetAttribute' => ['comentario_id' => 'id'],
                'message' => Yii::t('app', 'El comentario no existe.'),
            ],
            [['publicacion_id'], 'exist', 'skipOnError' => true,
                'targetClass' => Publicaciones::className(),
                'targetAttribute' => ['publicacion_id' => 'id'],
                'message' => Yii::t('app', 'La publicación no existe.')
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
            'contenido' => Yii::t('app', 'Contenido'),
            'created_at' => Yii::t('app', 'Fecha de creación'),
            'updated_at' => Yii::t('app', 'Última actualización'),
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

    /**
     * Devuelve el nombre de usuario como un link.
     * @return string
     */
    public function getUsername()
    {
        $user = $this->getUsuario()->one();
        if ($user->status == 10) {
            return Html::a($user->username, ['usuarios-completo/view', 'username' => $user->username]);
        }
        return $user->username;
    }

    /**
     * Devuelve el permalink al comentario.
     * @return string
     */
    public function getPermalink()
    {
        return Html::a('#' . $this->id, [Url::to(), '#' => 'com' . $this->id]);
    }

    /**
     * Devuelve la url de la respuesta.
     * @return string
     */
    public function getRespuestaUrl()
    {
        if ($this->comentario_id) {
            return Html::a('#' . $this->comentario_id, [Url::to(), '#' => 'com' . $this->comentario_id]);
        }
    }

    public function isMine()
    {
        return $this->usuario_id == Yii::$app->user->id;
    }

    /**
     * Indica si el comentario ha sido "borrado".
     * @return bool
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    public function getUnName()
    {
        return Yii::t('app', 'un comentario');
    }

    public function getNotificacionReceptor()
    {
        $publicacion = Publicaciones::findOne($this->publicacion_id);
        return $publicacion->usuario_id;
    }

    public function getUpdateMessage()
    {
        return Yii::t('app', 'Ha eliminado ') . $this->getUnName() . '.';
    }

    public function getRawUrl()
    {
        return Url::to(['publicaciones/view', 'id' => $this->publicacion_id, '#' => 'com' . $this->id]);
    }
}
