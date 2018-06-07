<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;

use common\models\ActividadRecienteSearch;
use common\models\ActividadReciente;
use common\utilities\ArtchiveCBase;

/**
 * ActividadRecienteController implements the CRUD actions for ActividadReciente model.
 *
 * INDEX.
 */
class ActividadRecienteController extends ArtchiveCBase
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
                    $this->mustBeAdmin(['index']),
                ],
            ],
        ];
    }

    public function init()
    {
        $this->class = new ActividadReciente();
        $this->search = new ActividadRecienteSearch();
        parent::init();
    }

    /**
     * Lists all ActividadReciente models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->commonIndex([
            'search' => $this->search,
            'order' => 'created_at DESC',
        ]);
    }
}
