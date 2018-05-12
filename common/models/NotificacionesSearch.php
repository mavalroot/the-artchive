<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Notificaciones;

/**
 * NotificacionesSearch represents the model behind the search form of `common\models\Notificaciones`.
 */
class NotificacionesSearch extends Notificaciones
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'tipo_notificacion_id'], 'integer'],
            [['notificacion', 'created_at'], 'safe'],
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
        $query = Notificaciones::find();

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
            'user_id' => $this->user_id,
            'tipo_notificacion_id' => $this->tipo_notificacion_id,
            'created_at' => $this->created_at,
            'seen' => $this->seen,
        ]);

        $query->andFilterWhere(['ilike', 'notificacion', $this->notificacion]);

        return $dataProvider;
    }
}
