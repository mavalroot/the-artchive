<?php

namespace common\models;

use Yii;

use yii\data\ActiveDataProvider;

use yii\helpers\Html;

/**
 * This is the model class for table "usuarios_completo".
 *
 * @property string $username
 * @property string $email
 * @property string $aficiones
 * @property string $tematica_favorita
 * @property string $plataforma
 * @property string $pagina_web
 * @property string $avatar
 * @property int $tipo_usuario
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
            [['tipo_usuario', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'aficiones', 'tematica_favorita', 'plataforma', 'pagina_web', 'avatar'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Nombre de usuario',
            'email' => 'E-mail',
            'aficiones' => 'Aficiones',
            'tematica_favorita' => 'Temática favorita',
            'plataforma' => 'Plataforma',
            'pagina_web' => 'Página web',
            'avatar' => 'Avatar',
            'tipo_usuario' => 'Tipo de suario',
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
     * Devuelve un array con la url del view de ese usuario.
     * @return array
     */
    public function getUrl()
    {
        return ['usuarios-completo/view', 'username' => $this->username];
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
        return Personajes::find()->where(['usuario_id' => $this->getUser()->id]);
    }

    /**
     * Devuelve los personajes de éste usuario en forma de ActiveDataProvider.
     * @return ActiveDataProvider
     */
    public function getMisPersonajes()
    {
        return $dataProvider = new ActiveDataProvider([
            'query' => $this->getPersonajes(),
        ]);
    }
}
