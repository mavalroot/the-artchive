<?php

namespace backend\controllers;

use yii\filters\AccessControl;
use common\models\Publicaciones;
use common\models\PublicacionesSearch;

use common\utilities\ArtchiveCBase;

/**
 * PublicacionesController implements the CRUD actions for Publicaciones model.
 *
 * INDEX, VIEW, UPDATE, DELETE
 */
class PublicacionesController extends ArtchiveCBase
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
        $this->class = new Publicaciones();
        $this->search = new PublicacionesSearch();
        parent::init();
    }
}
