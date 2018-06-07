<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UsuariosCompleto;

/**
 * UsuariosCompletoSearch represents the model behind the search form of `common\models\UsuariosCompleto`.
 */
class UsuariosCompletoSearch extends UsuariosCompleto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'seguidores', 'siguiendo', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'aficiones', 'tematica_favorita', 'bio', 'pagina_web', 'avatar', 'tipo'], 'safe'],
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
        $query = UsuariosCompleto::find();

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
            'seguidores' => $this->seguidores,
            'siguiendo' => $this->siguiendo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'username', $this->username])
            ->andFilterWhere(['ilike', 'email', $this->email])
            ->andFilterWhere(['ilike', 'aficiones', $this->aficiones])
            ->andFilterWhere(['ilike', 'tematica_favorita', $this->tematica_favorita])
            ->andFilterWhere(['ilike', 'bio', $this->bio])
            ->andFilterWhere(['ilike', 'pagina_web', $this->pagina_web])
            ->andFilterWhere(['ilike', 'avatar', $this->avatar])
            ->andFilterWhere(['ilike', 'tipo', $this->tipo]);

        return $dataProvider;
    }
}
