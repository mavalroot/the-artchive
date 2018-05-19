<?php

namespace common\utilities;

use Yii;

use yii\filters\VerbFilter;

use common\models\Personajes;
use common\models\TiposUsuario;
use common\models\MensajesPrivados;
use common\models\Publicaciones;

/**
 *
 */
trait Permisos
{
    /**
     * Los usuarios deben estar conectados para acceder.
     * @param  array $actions Acciones del controlador a las que afecta el
     * permiso.
     * @return array
     */
    public function mustBeLogged($actions)
    {
        return [
            'actions' => $actions,
            'allow' => true,
            'roles' => ['@'],
        ];
    }

    /**
     * Los usuarios deben ser administradores para acceder.
     * @param  array $actions Acciones del controlador a las que afecta el
     * permiso.
     * @return array
     */
    public function mustBeAdmin($actions)
    {
        return [
            'actions' => $actions,
            'allow' => true,
            'roles' => ['@'],
            'matchCallback' => function () {
                return Yii::$app->user->identity->tipo_usuario == TiposUsuario::getOne(TiposUsuario::ADMIN);
            }
        ];
    }

    /**
     * Los usuarios deben ser moderadores para acceder.
     * @param  array $actions Acciones del controlador a las que afecta el
     * permiso.
     * @return array
     */
    public function mustBeMod($actions)
    {
        return [
            'actions' => $actions,
            'allow' => true,
            'roles' => ['@'],
            'matchCallback' => function () {
                return Yii::$app->user->identity->tipo_usuario == TiposUsuario::getOne(TiposUsuario::MOD);
            }
        ];
    }

    /**
     * Los usuarios deben sermoderadores o adminsitradores para acceder.
     * @param  array $actions Acciones del controlador a las que afecta el
     * permiso.
     * @return array
     */
    public function mustBeAdminOrMod($actions)
    {
        return [
            'actions' => $actions,
            'allow' => true,
            'roles' => ['@'],
            'matchCallback' => function () {
                return Yii::$app->user->identity->tipo_usuario != TiposUsuario::getOne(TiposUsuario::NORMAL);
            }
        ];
    }

    /**
     * El mensaje privado debe haber sido enviado o recibido por el usuario.
     * @param  array $actions Acciones del controlador a las que afecta el
     * permiso.
     * @return array
     */
    public function mustBeMyMessage($actions)
    {
        return [
            'allow' => true,
            'actions' => $actions,
            'matchCallback' => function () {
                $mensaje = MensajesPrivados::findOne(Yii::$app->request->get('id'));
                $id = Yii::$app->user->id;
                return $id == $mensaje->receptor_id || $id == $mensaje->emisor_id;
            }
        ];
    }

    /**
     * El personaje debe ser propiedad del usuario.
     * @param  array $actions Acciones del controlador a las que afecta el
     * permiso.
     * @return array
     */
    public function mustBeMyCharacter($actions)
    {
        return [
            'allow' => true,
            'actions' => $actions,
            'roles' => ['@'],
            'matchCallback' => function () {
                $personaje = Personajes::findOne(Yii::$app->request->get('id'));
                if ($personaje) {
                    return Yii::$app->user->id == $personaje->usuario_id;
                }
            }
        ];
    }

    /**
     * La publicación debe ser propiedad del usuario.
     * @param  array $actions Acciones del controlador a las que afecta el
     * permiso.
     * @return array
     */
    public function mustBeMyContent($actions)
    {
        return [
            'allow' => true,
            'actions' => $actions,
            'roles' => ['@'],
            'matchCallback' => function () {
                $personaje = Publicaciones::findOne(Yii::$app->request->get('id'));
                if ($personaje) {
                    return Yii::$app->user->id == $personaje->usuario_id;
                }
            }
        ];
    }

    /**
     * La cuenta debe ser propiedad del usuario..
     * @param  array $actions Acciones del controlador a las que afecta el
     * permiso.
     * @return array
     */
    public function mustBeMyAccount($actions)
    {
        return [
            'allow' => true,
            'actions' => $actions,
            'roles' => ['@'],
            'matchCallback' => function () {
                return Yii::$app->user->identity->username == Yii::$app->request->get('username');
            }
        ];
    }

    /**
     * Los invitados pueden acceder.
     * @param  array $actions Acciones del controlador a las que afecta el
     * permiso.
     * @return array
     */
    public function mustBeGuest($actions)
    {
        return [
            'actions' => $actions,
            'allow' => true,
            'roles' => ['?'],
        ];
    }

    /**
     * Cuaquiera puede acceder.
     * @param  array $actions Acciones del controlador a las que afecta el
     * permiso.
     * @return array
     */
    public function anyCanAccess($actions)
    {
        return [
            'actions' => $actions,
            'allow' => true,
        ];
    }

    /**
     * El usuario debe estar loggeado para poder acceder a cualquierr acción.
     * @return array
     */
    public function mustBeLoggedForAll()
    {
        return [
            'allow' => true,
            'roles' => ['@'],
        ];
    }

    /**
     * El parámetro recibido en esa action llega por POST.
     * @param  array $actions Acciones del controlador a las que afecta el
     * permiso.
     * @return array
     */
    public function paramByPost($actions)
    {
        $result = [];
        foreach ($actions as $value) {
            $result[$value] = ['POST'];
        }

        return [
            'class' => VerbFilter::className(),
            'actions' => $result
        ];
    }
}
