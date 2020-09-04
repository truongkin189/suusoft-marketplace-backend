<?php

namespace backend\modules\transport\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\transport\models\TransportDriver;

/**
 * TransportDriverSearch represents the model behind the search form about `backend\modules\transport\models\TransportDriver`.
 */
class TransportDriverSearch extends TransportDriver
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'driver_experience', 'online_duration', 'is_delivery', 'is_online', 'is_active'], 'integer'],
            [['driver_license', 'online_started', 'type', 'created_date', 'modified_date'], 'safe'],
            [['fare'], 'number'],
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
        $query = TransportDriver::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'driver_experience' => $this->driver_experience,
            'online_duration' => $this->online_duration,
            'fare' => $this->fare,
            'is_delivery' => $this->is_delivery,
            'is_online' => $this->is_online,
            'is_active' => $this->is_active,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
        ]);

        $query->andFilterWhere(['like', 'driver_license', $this->driver_license])
            ->andFilterWhere(['like', 'online_started', $this->online_started])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
