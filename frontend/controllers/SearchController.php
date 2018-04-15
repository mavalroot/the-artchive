<?php
namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

use common\models\Personajes;
use common\models\User;

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
        $columnas = [];
        if ($src == 'pj') {
            $attr = 'nombre';
            $query = Personajes::find()->select('personajes.*, user.username as creator')->joinWith(['usuario'])->where(['like', $attr, $st]);
            $columnas[] = ['attribute' => 'creator', 'format' => 'raw', 'value' => function ($model) {
                return $model->getCreator();
            }];
        } else {
            $attr = 'username';
            $query = User::find()->where([$attr => $st])->orderBy("$attr ASC");
        }
        if ($query->count() == 0) {
            return $this->render('search');
        }
        $columnas[] = ['attribute' => $attr, 'format' => 'raw', 'value' => function ($model) {
            return $model->getUrl();
        }];
        $columnas[] = 'created_at:date';
        return $this->render('search', [
            'query' => $query,
            'columnas' => $columnas,
        ]);
    }
}
