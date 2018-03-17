<?php
namespace frontend\models;

use Yii;

use yii\base\Model;
use common\models\User;
use common\models\UsuariosDatos;

/**
 * Signup form
 */
class DeleteAccountForm extends Model
{
    public $username;
    public $personajes;
    public $publicaciones;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'compare', 'compareValue' => (Yii::$app->user->identity->username), 'message' => 'El nombre de usuario no coincide.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            [['personajes', 'publicaciones'], 'string'],
            [['personajes', 'publicaciones'], 'in', 'range' => ['0', '1']],
        ];
    }
}
