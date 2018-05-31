<?php

namespace common\utilities;

use common\models\User;
use common\models\UsuariosCompleto;

/**
 *

 */
trait Apto
{
    public function isApto()
    {
        if ($this->usuario_id) {
            $usuario = UsuariosCompleto::findOne(['id' => $this->usuario_id]);
            return $usuario->status == User::STATUS_ACTIVE && !$usuario->isBlocked() && !$usuario->imBlocked();
        }
    }
}
