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
    /**
     * Término de búsqueda.
     * @var string
     */
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

    /**
     * Busca por personaje.
     * @return PersonajesSearch
     */
    public function searchPj()
    {
        $searchModel = new PersonajesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->where(['nombre' => $this->searchTerm]);

        return $dataProvider;
    }

    /**
     * Devuelve las columnas de la tabla personajes que se mostrarán.
     * @return array
     */
    public function getPjColumns()
    {
        $columns = [];
        $columns[] = [
            'attribute' => 'nombre',
            'format' => 'html',
            'value' => function ($model) {
                return $model->getUrl();
            }
        ];
        $columns[] = [
            'attribute' => 'creator',
            'format' => 'html',
            'value' => function ($model) {
                return $model->getUrlCreator();
            }
        ];
        $columns[] = 'created_at:date';
        $columns[] = 'updated_at:relativetime';
        return $columns;
    }

    /**
     * Busca un usuario.
     * @return UsuariosCompletoSearch
     */
    public function searchUser()
    {
        $searchModel = new UsuariosCompletoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->where(['username' => $this->searchTerm]);
        return $dataProvider;
    }

    /**
     * Devuelve las columnas de la tabla usuarios que se mostrarán.
     * @return array
     */
    public static function getUserColumns()
    {
        $columns = [];
        $columns[] = [
            'attribute' => 'username',
            'format' => 'html',
            'value' => function ($model) {
                return $model->getUser()->getUrl();
            }
        ];
        $columns[] = 'created_at:date';
        $columns[] = 'updated_at:relativetime';
        return $columns;
    }
}
