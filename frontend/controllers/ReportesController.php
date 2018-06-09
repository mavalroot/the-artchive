<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;

use common\models\Reportes;
use common\models\ReportesSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\utilities\ArtchiveCBase;

/**
 * ReportesController implements the CRUD actions for Reportes model.
 */
class ReportesController extends ArtchiveCBase
{
    use \common\utilities\Permisos;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    $this->mustBeLoggedForAll(),
                ],
            ],
        ];
    }

    public function init()
    {
        $this->class = new Reportes();
        $this->search = new ReportesSearch();
        parent::init();
    }

    public function whatIDo()
    {
        return ['update', 'create', 'find'];
    }

    /**
     * Lists all Reportes models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->commonIndex([
            'search' => $this->search,
            'where' => ['created_by' => Yii::$app->user->id],
        ]);
    }

    /**
     * Creates a new Reportes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->class->created_by = Yii::$app->user->id;
        return parent::actionCreate();
    }
}
