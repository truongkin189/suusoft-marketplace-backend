<?php

namespace backend\modules\product\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\product\models\ProductDeal;

/**
 * ProductDealSearch represents the model behind the search form about `backend\modules\product\models\ProductDeal`.
 */
class ProductDealSearch extends ProductDeal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'seller_id', 'quantity', 'discount_rate', 'is_online', 'online_duration', 'is_premium', 'is_renew', 'is_active', 'view_count', 'like_count', 'rate_count', 'reservation_count'], 'integer'],
            [['category_id', 'image', 'attachment', 'name', 'description', 'content', 'discount_type', 'discount_expired', 'online_started', 'status', 'lat', 'long', 'country', 'state', 'city', 'address', 'created_date', 'created_user', 'modified_date', 'modified_user', 'application_id'], 'safe'],
            [['price', 'sale_price', 'discount', 'rate'], 'number'],
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
    public function search($params,$type='')
    {
        if(strcmp($type,'') == 0)
        {
            $query = ProductDeal::find();
        }
        else
        {
            $query = ProductDeal::find()
            ->where(['is_active' => $type])
            ->orderBy('created_date DESC');;
        }
        

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
            'seller_id' => $this->seller_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'discount' => $this->discount,
            'discount_rate' => $this->discount_rate,
            'discount_expired' => $this->discount_expired,
            'is_online' => $this->is_online,
            'online_duration' => $this->online_duration,
            'is_premium' => $this->is_premium,
            'is_renew' => $this->is_renew,
            'is_active' => $this->is_active,
            'view_count' => $this->view_count,
            'like_count' => $this->like_count,
            'rate' => $this->rate,
            'rate_count' => $this->rate_count,
            'reservation_count' => $this->reservation_count,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
        ]);

        $query->andFilterWhere(['like', 'category_id', $this->category_id])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'attachment', $this->attachment])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'discount_type', $this->discount_type])
            ->andFilterWhere(['like', 'online_started', $this->online_started])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'long', $this->long])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'created_user', $this->created_user])
            ->andFilterWhere(['like', 'modified_user', $this->modified_user])
            ->andFilterWhere(['like', 'application_id', $this->application_id]);

        return $dataProvider;
    }
}
