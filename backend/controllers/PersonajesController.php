<?php

namespace backend\controllers;

use yii\filters\AccessControl;
use common\models\Personajes;
use common\models\PersonajesSearch;
use common\utilities\ArtchiveCBase;

/**
 * PersonajesController implements the CRUD actions for Personajes model.
 */
class PersonajesController extends ArtchiveCBase
{
    use \common\utilities\Permisos;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    $this->mustBeAdmin(['index', 'view', 'update', 'delete']),
                ],
            ],
            'verbs' => $this->paramByPost(['delete']),
        ];
    }

    public function init()
    {
        $this->class = new Personajes();
        $this->search = new PersonajesSearch();
        parent::init();
    }
}
