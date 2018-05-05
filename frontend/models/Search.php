<?php
namespace frontend\models;

use Yii;

use yii\base\Model;

use common\models\PersonajesSearch;
use common\models\UsuariosCompletoSearch;

/**
 *
 */
class Search extends Model
{
    public $searchTerm;

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            ['st', 'string', 'min' => 2, 'max' => 255],
            ['src', 'in', 'range' => ['pj', 'user']],
        ];
    }

    public function searchPj()
    {
        $searchModel = new PersonajesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->where(['nombre' => $this->searchTerm]);

        return $dataProvider;
    }

    public function getPjColumns()
    {
        $columns = [];
        $columns[] = [
            'attribute' => 'nombre',
            'format' => 'raw',
            'value' => function ($model) {
                return $model->getUrl();
            }
        ];
        $columns[] = [
            'attribute' => 'creator',
            'format' => 'raw',
            'value' => function ($model) {
                return $model->GetUrlCreator();
            }
        ];
        $columns[] = 'created_at:date';
        $columns[] = 'updated_at:relativetime';
        return $columns;
    }

    public function searchUser()
    {
        $searchModel = new UsuariosCompletoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->where(['username' => $this->searchTerm]);
        return $dataProvider;
    }

    public static function getUserColumns()
    {
        $columns = [];
        $columns[] = [
            'attribute' => 'username',
            'format' => 'raw',
            'value' => function ($model) {
                return $model->getUser()->getUrl();
            }
        ];
        $columns[] = 'created_at:date';
        $columns[] = 'updated_at:relativetime';
        return $columns;
    }
}
