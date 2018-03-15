<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MensajesPrivados;

/**
 * MensajesPrivadosSearch represents the model behind the search form of `common\models\MensajesPrivados`.
 */
class MensajesPrivadosSearch extends MensajesPrivados
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'emisor_id', 'receptor_id'], 'integer'],
            [['asunto', 'contenido', 'created_at', 'receptor_name', 'emisor_name'], 'safe'],
            [['del_e', 'del_r', 'leido'], 'boolean'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['emisor_name', 'receptor_name']);
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
        $query = MensajesPrivados::find()->leftJoin('user r', 'receptor_id = r.id')->leftJoin('user e', 'emisor_id = e.id')->select('r.username AS receptor_name, e.username AS emisor_name, mensajes_privados.*')->orderBy(['created_at' => SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
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
            'emisor_id' => $this->emisor_id,
            'receptor_id' => $this->receptor_id,
            'del_e' => $this->del_e,
            'del_r' => $this->del_r,
            'leido' => $this->leido,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['ilike', 'asunto', $this->asunto])
            ->andFilterWhere(['ilike', 'contenido', $this->contenido]);

        return $dataProvider;
    }
}
