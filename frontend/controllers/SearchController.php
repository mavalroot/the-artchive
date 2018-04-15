<?php
namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

use common\models\Personajes;
use common\models\User;

use frontend\models\Search;

/**
 * Asfasd
 */
class SearchController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
        return new Search(['search_term' => $st]);
    }
}
