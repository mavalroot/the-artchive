<?php

namespace backend\controllers;

use yii\filters\AccessControl;
use common\models\Reportes;
use common\models\ReportesSearch;
use yii\web\Controller;

/**
 * ReportesController implements the CRUD actions for Reportes model.
 *
 * INDEX, VIEW, UPDATE, DELETE
 */
class ReportesController extends Controller
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
                    $this->mustBeAdmin(['index', 'view', 'update', 'delete']),
                ],
            ],
            'verbs' => $this->paramByPost(['delete']),
        ];
    }

    public function init()
    {
        $this->class = new Reportes();
        $this->search = new ReportesSearch();
        parent::init();
    }
}
