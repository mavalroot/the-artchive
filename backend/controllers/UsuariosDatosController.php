<?php

namespace backend\controllers;

use yii\filters\AccessControl;
use common\models\UsuariosDatos;
use common\utilities\ArtchiveCBase;

/**
 * UsuariosDatosController implements the CRUD actions for UsuariosDatos model.
 *
 * UPDATE
 */
class UsuariosDatosController extends ArtchiveCBase
{
    use \common\utilities\Permisos;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    $this->mustBeAdmin(['update']),
                ],
            ],
        ];
    }

    public function init()
    {
        $this->class = new UsuariosDatos();
        $this->search = null;
        parent::init();
    }
}
