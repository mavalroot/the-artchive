<?php

namespace common\models;

use Yii;

use yii\data\ActiveDataProvider;

use yii\helpers\Html;

/**
 * This is the model class for table "usuarios_completo".
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
            [['username', 'email', 'aficiones', 'tematica_favorita', 'bio', 'pagina_web', 'avatar'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Nombre de usuario',
            'email' => 'E-mail',
            'aficiones' => 'Aficiones',
            'tematica_favorita' => 'Temática favorita',
            'bio' => 'bio',
            'pagina_web' => 'Página web',
            'avatar' => 'Avatar',
            'tipo' => 'Tipo de usuario',
            'seguidores' => 'Seguidores',
            'siguiendo' => 'Siguiendo',
            'created_at' => 'Fecha de registro',
            'updated_at' => 'Última actualización',
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

    public function getPublicaciones()
    {
        return Publicaciones::find()->where(['usuario_id' => $this->id]);
    }

    public function getBloqueos()
    {
        return Bloqueos::find()->where(['bloqueado_id' => $this->id]);
    }

    public function isBlocked()
    {
        return $this->getBloqueos()->andWhere([
            'usuario_id' => Yii::$app->user->id
        ])
        ->count() != 0;
    }

    public function imBlocked()
    {
        return $this->getBloqueos()->where([
            'usuario_id' => $this->id,
            'bloqueado_id' => Yii::$app->user->id,
        ])
        ->count() != 0;
    }

    public function getMisPublicaciones()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getPublicaciones()->orderBy(['updated_at' => SORT_DESC])->limit(3),
            'pagination' => false,
            'sort' => false,
        ]);
        return $dataProvider;
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

    public function getBlockButton()
    {
        if (!$this->isSelf() && $this->isBlocked()) {
            return
            Html::beginForm('block.php', 'post', ['name' => 'unblock']) .
            Html::hiddenInput('id', $this->id) .
            Html::submitButton('Desbloquear', ['class' => 'btn btn-sm btn-primary']) .
            Html::endForm();
        } elseif (!$this->isSelf() && !$this->isBlocked()) {
            return
            Html::beginForm('', 'post', ['name' => 'block']) .
            Html::hiddenInput('id', $this->id) .
            Html::submitButton('Bloquear', ['class' => 'btn btn-sm btn-primary']) .
            Html::endForm();
        }
    }

    public function getMpButton()
    {
        if (!$this->isSelf() && !$this->isBlocked() && !$this->imBlocked()) {
            return Html::a('Mandar MP', ['/mensajes-privados/create', 'username' => $this->username], ['class' => 'btn btn-md btn-info']);
        }
    }

    public function getFollowButtons()
    {
        if (!$this->isSelf() && $this->siguiendo() && !$this->isBlocked() && !$this->imBlocked()) {
            return
            Html::beginForm('', 'post', ['name' => 'unfollow']) .
            Html::hiddenInput('id', $this->id) .
            Html::submitButton('Dejar de seguir', ['class' => 'btn btn-sm btn-primary']) .
            Html::endForm();
        } elseif (!$this->isSelf() && !$this->siguiendo() && !$this->isBlocked() && !$this->imBlocked()) {
            return
            Html::beginForm('', 'post', ['name' => 'follow']) .
            Html::hiddenInput('id', $this->id) .
            Html::submitButton('Seguir', ['class' => 'btn btn-sm btn-primary']) .
            Html::endForm();
        }
    }
}
