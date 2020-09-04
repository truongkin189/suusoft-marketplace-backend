<?php

namespace backend\modules\app\models\appuserrefund;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\app\models\appuserrefund\AppUserRefundRequest;

/**
 * AppUserRefundRequestSearch represents the model behind the search form about `backend\modules\app\models\appuserrefund\AppUserRefundRequest`.
 */
class AppUserRefundRequestSearch extends AppUserRefundRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'buyer_id', 'seller_id', 'order_id', 'product_id', 'status'], 'integer'],
            [['amount'], 'number'],
            [['type', 'note', 'time', 'created_at', 'modified_at'], 'safe'],
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
        $query = AppUserRefundRequest::find();

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
            'buyer_id' => $this->buyer_id,
            'seller_id' => $this->seller_id,
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'amount' => $this->amount,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'modified_at' => $this->modified_at,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'time', $this->time]);

        return $dataProvider;
    }
}
