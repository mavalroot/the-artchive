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

    /**
     * Busca un usuario o personaje.
     * @param  string $st  Término de búsqueda.
     * @param  string $src Qué busca ('user' o 'pj')
     * @return mixed
     */
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

    /**
     * Crea un nuevo Search con el término de búsqueda.
     * @param  string $st
     * @return Search
     */
    protected function findModel($st)
    {
        return new Search(['searchTerm' => $st]);
    }
}
