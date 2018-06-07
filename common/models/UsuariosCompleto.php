<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

/**
 * This is the model class for table "usuarios_completo".d
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $aficiones
 * @property string $tematica_favorita
 * @property string $bio
 * @property string $pagina_web
 * @property string $avatar
 * @property string $tipo
 * @property int $seguidores
 * @property int $siguiendo
 * @property int $created_at
 * @property int $updated_at
 */
class UsuariosCompleto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios_completo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['tipo_usuario', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['id', 'seguidores', 'siguiendo', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'aficiones', 'tematica_favorita', 'bio', 'pagina_web', 'avatar'],
                'string', 'max' => 255,
                'message' => Yii::t('app', 'No puede superar los 255 carácteres.'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Nombre de usuario'),
            'email' => 'E-mail',
            'aficiones' => Yii::t('app', 'Aficiones'),
            'tematica_favorita' => Yii::t('app', 'Temática favorita'),
            'bio' => Yii::t('app', 'Sobre mi'),
            'pagina_web' => Yii::t('app', 'Página web'),
            'avatar' => 'Avatar',
            'tipo' => Yii::t('app', 'Tipo de usuario'),
            'seguidores' => Yii::t('app', 'Seguidores'),
            'siguiendo' => Yii::t('app', 'Siguiendo'),
            'created_at' => Yii::t('app', 'Fecha de registro'),
            'updated_at' => Yii::t('app', 'Última actualización'),
        ];
    }

    public static function primaryKey()
    {
        return ['username'];
    }

    /**
     * Indica si el usuario conectado coincide con el usuario que se muestra.
     * @return bool Devuelve true si coincide y false si no coincide.
     */
    public function isSelf()
    {
        return $this->username == Yii::$app->user->identity->username;
    }

    /**
     * Obtener la instancia de "User" que corresponde a este usuario.
     * @return User
     */
    public function getUser()
    {
        return User::findOne(['username' => $this->username]);
    }

    /**
     * Devuelve los personajes de un usuario.
     * @return Personajes
     */
    public function getPersonajes()
    {
        return Personajes::find()->where(['usuario_id' => $this->id]);
    }

    /**
     * Devuelve las publicaciones de un usuario.
     * @return Publicaciones
     */
    public function getPublicaciones()
    {
        return Publicaciones::find()->where(['usuario_id' => $this->id]);
    }

    /**
     * Devuelve los bloqueos de un usuario.
     * @return Bloqueos
     */
    public function getBloqueos()
    {
        return Bloqueos::find()->where(['bloqueado_id' => $this->id]);
    }

    /**
     * Indica si el usuario ha sido bloqueado por el usuario conectado.
     * @return bool
     */
    public function isBlocked()
    {
        return $this->getBloqueos()->andWhere([
            'usuario_id' => Yii::$app->user->id
        ])
        ->count() != 0;
    }

    /**
     * Indica si el usuario tiene bloqueado al usuario conectado.
     * @return bool
     */
    public function imBlocked()
    {
        return Bloqueos::find()->where([
            'usuario_id' => $this->id,
            'bloqueado_id' => Yii::$app->user->id,
        ])
        ->count() != 0;
    }

    /**
     * Devuelve si el usuario es apto. Esto quiere decir que debe ser activo,
     * no haber sido bloqueado por el usuario conectado ni haber bloqueado
     * al usuario conectado.
     * @return bool
     */
    public function isApto()
    {
        return $this->status == User::STATUS_ACTIVE && !($this->isBlocked() || $this->imBlocked());
    }

    /**
     * Indica si el usuario actual está siguiendo a este usuario.
     * @return bool True si ya lo está siguiendo o false si no.
     */
    public function siguiendo()
    {
        return Seguidores::find()
        ->where([
            'usuario_id' => $this->id,
            'seguidor_id' => Yii::$app->user->id
        ])
        ->count() !== 0;
    }

    /**
     * Devuelve un array con la url del view de ese usuario.
     * @return array
     */
    public function getUrl()
    {
        return Html::a($this->username, ['usuarios-completo/view', 'username' => $this->username]);
    }

    /**
     * Si el usuario ha sido bloqueado también deja de seguirlo / seguirte.
     * @param  int $id Id del usuario
     */
    public function bloquearSeguidor($id)
    {
        $siguiendo = Seguidores::findOne([
            'usuario_id' => $id,
            'seguidor_id' => Yii::$app->user->id
        ]);
        if (isset($siguiendo)) {
            $siguiendo->delete();
        }

        $seguidor = Seguidores::findOne([
            'usuario_id' => Yii::$app->user->id,
            'seguidor_id' => $id
        ]);

        if (isset($seguidor)) {
            $seguidor->delete();
        }
    }

    /**
     * Devuelve los botones de bloquear y desbloquear.
     * @return string
     */
    public function getBlockButton()
    {
        if (!$this->isSelf() && !$this->imBlocked() && $this->isBlocked()) {
            return
            Html::beginForm('block.php', 'post', ['name' => 'unblock']) .
            Html::hiddenInput('id', $this->id) .
            Html::submitButton(Yii::t('app', 'Desbloquear'), ['class' => 'btn btn-sm btn-primary']) .
            Html::endForm();
        } elseif (!$this->isSelf() && $this->isApto()) {
            return
            Html::beginForm('', 'post', ['name' => 'block']) .
            Html::hiddenInput('id', $this->id) .
            Html::submitButton(Yii::t('app', 'Bloquear'), ['class' => 'btn btn-sm btn-primary']) .
            Html::endForm();
        }
    }

    /**
     * Devuelve el botón de mandar un mp.
     * @return string
     */
    public function getMpButton()
    {
        if (!$this->isSelf() && $this->isApto()) {
            return Html::a(Yii::t('app', 'Mandar MP'), ['/mensajes-privados/create', 'username' => $this->username], ['class' => 'btn btn-sm btn-info']);
        }
    }

    /**
     * Devuelve los botones de seguir y dejar de seguir.
     * @return string
     */
    public function getFollowButtons()
    {
        if (!$this->isSelf() && $this->siguiendo() && $this->isApto()) {
            return
            Html::beginForm('', 'post', ['name' => 'unfollow']) .
            Html::hiddenInput('id', $this->id) .
            Html::submitButton(Yii::t('app', 'Dejar de seguir'), ['class' => 'btn btn-sm btn-primary']) .
            Html::endForm();
        } elseif (!$this->isSelf() && !$this->siguiendo() && $this->isApto()) {
            return
            Html::beginForm('', 'post', ['name' => 'follow']) .
            Html::hiddenInput('id', $this->id) .
            Html::submitButton(Yii::t('app', 'Seguir'), ['class' => 'btn btn-sm btn-primary']) .
            Html::endForm();
        }
    }

    /**
     * Devuelve un botón que lleva a los personajes del usuario.
     * @return [type] [description]
     */
    public function getCharactersButton()
    {
        if ($this->isApto()) {
            return
            Html::beginTag('p', ['class' => 'text-center']) .
            Html::a(Yii::t('app', 'Ver personajes'), ['personajes/index', 'username' => $this->username], ['class' => 'btn btn-success']) .
            Html::endTag('p');
        }
    }

    /**
     * Devuelve el avatar como una imagen
     * @return [type] [description]
     */
    public function getImgAvatar()
    {
        return Html::img($this->avatar ?: '/uploads/default.png', [
            'title' => $this->username,
            'alt' => $this->username,
        ]);
    }
}
