<?php
namespace frontend\models;

use Yii;

use yii\base\Model;

use common\models\User;
use common\models\UsuariosDatos;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('frontend', 'Nombre de usuario'),
            'password' => Yii::t('frontend', 'Contraseña'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        // $user->status = 20;
        $user->status = 10; // Temporalmente, para poder hacer registros sin necesitar correo de confirmación


        if ($user->save()) {
            $this->crearDatos($user->id);
            return $user;
        } else {
            return null;
        }

        return $user->save() ? $user : null;
    }

    /**
     * Crea los datos asociados al nuevo usuario.
     * @param  int $id Id del usuario registrado.
     */
    public function crearDatos($id)
    {
        $datos = new UsuariosDatos();
        $datos->usuario_id = $id;
        $datos->save();
    }
}
