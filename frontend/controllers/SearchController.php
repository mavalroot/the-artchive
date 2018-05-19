<?php
namespace frontend\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

use frontend\models\Search;

/**
 * Asfasd
 */
class SearchController extends Controller
{
    use \common\utilities\Permisos;
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    $this->mustBeLoggedForAll(),
                ],
            ],
        ];
    }

    public function actionSearch($st = '', $src = 'user')
    {
        $model = $this->findModel($st);
        if ($src == 'pj') {
            $dataProvider = $model->searchPj();
            $columnas = $model->getPjColumns();
        } else {
            $dataProvider = $model->searchUser();
            $columnas = $model->getUserColumns();
        }

        return $this->render('search', [
            'dataProvider' => $dataProvider,
            'columnas' => $columnas,
        ]);
    }

    protected function findModel($st)
    {
        return new Search(['searchTerm' => $st]);
    }
}
