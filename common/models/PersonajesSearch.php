<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Personajes;

/**
 * PersonajesSearch represents the model behind the search form of `common\models\Personajes`.
 */
class PersonajesSearch extends Personajes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id'], 'integer'],
            [['nombre', 'fecha_nac', 'historia', 'personalidad', 'apariencia', 'hechos_destacables', 'created_at', 'updated_at', 'creator'], 'safe'],
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
        $query = Personajes::find()->select('personajes.*, user.username as creator')->joinWith('usuario');

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

        $dataProvider->sort->attributes['creator'] = [
            'asc' => ['creator' => SORT_ASC],
            'desc' => ['creator' => SORT_DESC],
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'usuario_id' => $this->usuario_id,
            'fecha_nac' => $this->fecha_nac,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'historia', $this->historia])
            ->andFilterWhere(['ilike', 'personalidad', $this->personalidad])
            ->andFilterWhere(['ilike', 'apariencia', $this->apariencia])
            ->andFilterWhere(['ilike', 'hechos_destacables', $this->hechos_destacables]);

        return $dataProvider;
    }
}
