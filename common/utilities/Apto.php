<?php

namespace common\utilities;

use common\models\User;
use common\models\UsuariosCompleto;

/**
 *

 */
trait Apto
{
    /**
     * Indica si el usuario es apto o no (es decir, que no haya sido eliminado
     * ni esté bloqueado o haya sido bloqueado por el usuario actual).
     * @return bool
     */
    public function isApto()
    {
        if ($this->usuario_id) {
            $usuario = UsuariosCompleto::findOne(['id' => $this->usuario_id]);
            return $usuario->status == User::STATUS_ACTIVE && !$usuario->isBlocked() && !$usuario->imBlocked();
        }
    }
}
