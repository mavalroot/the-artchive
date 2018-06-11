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
class Comentarios extends \common\utilities\ArtchiveBase
{
    use \common\utilities\Apto;
    use \common\utilities\Notificacion;
    use \common\utilities\Creator;
    /**
     * Indica si ha sido citado.
     * @var bool
     */
    public $quoted;

    /**
     * Avatar del usuario que hizo el comentario.
     * @var string
     */
    public $avatar;

    /**
     * Nombre de usuario del usuario que hizo el comentario.
     * @var string
     */
    public $username;
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
            [['usuario_id'], 'validateNotBlocked'],
            [['usuario_id', 'publicacion_id', 'contenido'], 'required'],
            [['usuario_id', 'publicacion_id', 'comentario_id'], 'default', 'value' => null],
            [['deleted'], 'default', 'value' => false],
            ['deleted', 'boolean'],
            [['usuario_id', 'publicacion_id', 'comentario_id'], 'integer'],
            [['contenido'], 'string', 'max' => 500],
            [['created_at', 'updated_at'], 'safe'],
            [['comentario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comentarios::className(), 'targetAttribute' => ['comentario_id' => 'id']],
            [['publicacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Publicaciones::className(), 'targetAttribute' => ['publicacion_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * Valida que el personaje de la referencia no pueda ser el mismo.
     * @param  string $attribute
     */
    public function validateNotBlocked($attribute)
    {
        $publicacion = Publicaciones::findOne(['id' => $this->publicacion_id]);
        $usuario = UsuariosCompleto::findOne(['id' => $publicacion->usuario_id]);
        if ($usuario->imBlocked()) {
            $this->addError($attribute, Yii::t('app', 'No puedes comentar en esta publicación.'));
        }
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
     * Devuelve el avatar (como una imagen) del usuario al que pertenece el comentario.
     * @return [type] [description]
     */
    public function getAvatar()
    {
        $user = UsuariosCompleto::findOne(['id' => $this->usuario_id]);
        return Html::img(isset($user->avatar) ? $user->avatar : '/uploads/default.png');
    }

    /**
     * Devuelve el botón de responder.
     * @return string
     */
    public function getResponderButton()
    {
        if (!$this->comentario_id) {
            return Html::button(Yii::t('frontend', 'Responder'), ['name' => 'responder-comentario', 'class' => 'btn btn-xs btn-info']);
        }
    }

    /**
     * Devuelve el botón de borrar.
     * @return string
     */
    public function getBorrarButton()
    {
        $imAdmin = Yii::$app->user->identity->tipo_usuario == TiposUsuario::getOne(TiposUsuario::ADMIN);
        if (($this->isMine() || $imAdmin) && !$this->isDeleted()) {
            return Html::button(Yii::t('frontend', 'Borrar'), ['name' => 'borrar-comentario', 'class' => 'btn btn-xs btn-danger']);
        }
    }

    /**
     * Devuelve el botón de mostrar respuestas.
     * @return string
     */
    public function getMostrarRespuestasButton()
    {
        return Html::button(count($this->comentarios) . ' ' . Yii::t('app', 'respuestas'), ['name' => 'mostrar-respuestas', 'class' => 'btn btn-xs btn-link especial']);
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

    public function getUpdateMessage()
    {
        return Yii::t('app', 'Ha eliminado ') . $this->getUnName() . '.';
    }

    public function getRawUrl()
    {
        return Url::to(['publicaciones/view', 'id' => $this->publicacion_id]);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert && !$this->publicacion->isMine()) {
            $this->crearNotificacion([
                'url' => Url::to(['publicaciones/view', 'id' => $this->publicacion_id]),
                'user' => $this->publicacion->usuario_id,
            ]);
        }
        return true;
    }

    public function isHistorialSaved()
    {
        return true;
    }
}
