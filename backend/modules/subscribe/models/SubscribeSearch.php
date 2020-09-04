<?php

namespace backend\modules\subscribe\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\subscribe\models\Subscribe;

/**
 * SubscribeSearch represents the model behind the search form about `backend\modules\subscribe\models\Subscribe`.
 */
class SubscribeSearch extends Subscribe
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'subscriber_id', 'subscribed_id'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
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
        $query = Subscribe::find();

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
            'id' => $this->id,
            'subscriber_id' => $this->subscriber_id,
            'subscribed_id' => $this->subscribed_id,
            'created_at' => $this->created_at,
            'modified_at' => $this->modified_at,
        ]);

        return $dataProvider;
    }
}
