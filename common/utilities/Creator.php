<?php

namespace common\utilities;

use Yii;
use yii\helpers\Html;
use common\models\User;

/**
 *
 */
trait Creator
{
    /**
     * Indica si esta instancia es propiedad del usuario conectado actualmente.
     * Para ello primero se comprueba que exista la propiedad usuario_id, porque
     * en caso contrario no es una clase que pueda tener pertenencia.
     *
     * @return bool
     */
    public function isMine()
    {
        if (isset($this->usuario_id)) {
            return $this->usuario_id == Yii::$app->user->id;
        }
        return false;
    }

    /**
     * Devuelve el creador de esta instancia.
     * Para ello primero se comprueba que exista la propiedad usuario_id, porque
     * en caso contrario no es una clase que pueda tener creador.
     *
     * @return User|null
     */
    public function getCreator()
    {
        if (isset($this->usuario_id)) {
            return $this->hasOne(User::className(), ['id' => 'usuario_id']);
        }
        return null;
    }

    /**
     * Muestra el creador del personaje como un link.
     * Primero comprueba que la propiedad creator exista.
     *
     * @return string|bool
     */
    public function getUrlCreator()
    {
        if (isset($this->creator)) {
            return Html::a($this->creator, ['/usuarios-completo/view', 'username' => $this->creator]);
        }
        return false;
    }
}
