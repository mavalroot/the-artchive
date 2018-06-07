<?php
namespace frontend\models;

use Yii;

use yii\base\Model;
use common\models\User;
use common\models\Personajes;
use common\models\Seguidores;
use common\models\Publicaciones;
use common\models\UsuariosDatos;
use common\models\Notificaciones;
use common\models\MensajesPrivados;

/**
 * Signup form.
 */
class DeleteAccountForm extends Model
{
    /**
     * Nombre de usuario.
     * @var string
     */
    public $username;
    /**
     * Si los personajes serán eliminados (verdadero o falso).
     * @var bool
     */
    public $personajes;
    /**
     * Si las publicaciones serán eliminadas (verdadero o falso).
     * @var bool
     */
    public $publicaciones;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'compare', 'compareValue' => (Yii::$app->user->identity->username), 'message' => Yii::t('frontend', 'El nombre de usuario no coincide.')],
            ['username', 'string', 'min' => 2, 'max' => 255],

            [['personajes', 'publicaciones'], 'string'],
            [['personajes', 'publicaciones'], 'in', 'range' => ['0', '1']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('frontend', 'Nombre de usuario'),
            'personajes' => Yii::t('frontend', 'Personajes'),
            'publicaciones' => Yii::t('frontend', 'Publicaciones'),
        ];
    }

    /**
     * Desactiva el usuario.
     * @return bool
     */
    public function desactivarUsuario()
    {
        $model = $this->getUser();
        $model->username = '--' . $model->id . '--';
        $model->email = Yii::$app->security->generateRandomString();
        $model->status = 0;

        $this->username = $model->username;

        return $model->save();
    }

    /**
     * Borra todo lo relacionado con el usuario que se ha desactivado.
     */
    public function borrarTodo()
    {
        $this->borrarPjs();
        $this->borrarPublicaciones();
        $this->borrarRastro();
    }

    /**
     * Borra los personajes del usuario.
     */
    public function borrarPjs()
    {
        $model = $this->getUser();
        if ($this->personajes) {
            Publicaciones::deleteAll(['usuario_id' => $model->id]);
        }
    }

    /**
     * Borra las publicaciones del usuario.
     */
    public function borrarPublicaciones()
    {
        $model = $this->getUser();
        if ($this->personajes) {
            Personajes::deleteAll(['usuario_id' => $model->id]);
        }
    }

    /**
     * Borra todo el rastro del usuario.
     */
    public function borrarRastro()
    {
        $id = $this->getUser()->id;
        $datos = UsuariosDatos::findOne($id);
        $datos->delete();
        Seguidores::deleteAll(['usuario_id' => $id]);
        Seguidores::deleteAll(['seguidor_id' => $id]);
        MensajesPrivados::updateAll(['del_e' => true], 'emisor_id = ' . $id);
        MensajesPrivados::updateAll(['del_r' => true], 'receptor_id = ' . $id);
        Notificaciones::deleteAll(['usuario_id' => $id]);
    }

    /**
     * Devuelve el usuario que se va a eliminar.
     * @return User
     */
    public function getUser()
    {
        return User::findOne(['username' => $this->username]);
    }
}
