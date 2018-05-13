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
 * @property string $plataforma
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
            [['username', 'email', 'aficiones', 'tematica_favorita', 'plataforma', 'pagina_web', 'avatar'], 'string', 'max' => 255],
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
            'plataforma' => 'Plataforma',
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
     * Devuelve un botón para modificar el propio perfil.
     */
    public function getButtons()
    {
        $buttons = '';
        if ($this->isSelf()) {
            $buttons .= Html::a('Modificar mi perfil', ['/usuarios-datos/update', 'username' => Yii::$app->user->identity->username], ['class' => 'btn btn-md btn-success']);
        } else {
            $buttons .= Html::a('Mandar MP', ['/mensajes-privados/create', 'username' => $this->username], ['class' => 'btn btn-md btn-info']);
        }

        return $buttons;
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
        return $this->getBloqueos()->where([
            'usuario_id' => Yii::$app->user->id
        ])
        ->count() > 0;
    }

    /**
     * Devuelve los personajes de éste usuario en forma de ActiveDataProvider.
     * @return ActiveDataProvider
     */
    public function getMisPersonajes()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getPersonajes()->orderBy(['updated_at' => SORT_DESC])->limit(3),
            'pagination' => false,
            'sort' => false,
        ]);

        return $dataProvider;
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
     * Devuelve botones para ver seguidores y seguidos
     * @return string
     */
    public function getFollowButtons()
    {
        $buttons = '';
        $buttons .= Html::a($this->seguidores . ' seguidores', ['seguidores/index', 'username' => $this->username]);
        $buttons .= ' <br /> ' . Html::a($this->siguiendo . ' siguiendo', ['seguidores/following', 'username' => $this->username]);

        return $buttons;
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
}
