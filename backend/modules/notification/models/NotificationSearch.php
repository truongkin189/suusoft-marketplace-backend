<?php

namespace backend\modules\notification\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\notification\models\Notification;

/**
 * NotificationSearch represents the model behind the search form about `backend\modules\notification\models\Notification`.
 */
class NotificationSearch extends Notification
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'buyer_all', 'seller_all', 'buyer_only', 'buyer_id', 'seller_only', 'seller_id'], 'integer'],
            [['person_push_name', 'message', 'created_at'], 'safe'],
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
        $query = Notification::find();

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
            'buyer_all' => $this->buyer_all,
            'seller_all' => $this->seller_all,
            'buyer_only' => $this->buyer_only,
            'buyer_id' => $this->buyer_id,
            'seller_only' => $this->seller_only,
            'seller_id' => $this->seller_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'person_push_name', $this->person_push_name])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
