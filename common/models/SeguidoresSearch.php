<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Seguidores;

/**
 * SeguidoresSearch represents the model behind the search form of `common\models\Seguidores`.
 */
class SeguidoresSearch extends Seguidores
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id', 'seguidor_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Seguidores::find()
        ->select('seguidores.*, uc.username as segname, uc.avatar as segavatar, uc2.username as signame, uc2.avatar as sigavatar')
        ->leftJoin('usuarios_completo uc', 'seguidores.seguidor_id = uc.id')
        ->leftJoin('usuarios_completo uc2', 'seguidores.usuario_id = uc2.id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'usuario_id' => $this->usuario_id,
            'seguidor_id' => $this->seguidor_id,
        ]);

        return $dataProvider;
    }
}
