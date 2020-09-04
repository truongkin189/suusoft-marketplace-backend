<?php

namespace backend\modules\app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\app\models\AppUser;
use backend\modules\product\models\ProductDeal;
use backend\modules\product\models\Order;

/**
 * AppUserSearch represents the model behind the search form about `backend\modules\app\models\AppUser`.
 */
class AppUserSearch extends AppUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'qb_id', 'point', 'is_online', 'is_active', 'role', 'rate_count'], 'integer'],
            [['avatar', 'name', 'username', 'email', 'password', 'auth_key', 'password_hash', 'password_reset_token', 'description', 'content', 'gender', 'dob', 'phone', 'weight', 'height', 'address', 'country', 'state', 'city', 'card_number', 'card_cvv', 'card_exp', 'lat', 'long', 'type', 'status', 'created_date', 'modified_date'], 'safe'],
            [['balance', 'rate'], 'number'],
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
        $query = AppUser::find();

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
            'qb_id' => $this->qb_id,
            'balance' => $this->balance,
            'point' => $this->point,
            'is_online' => $this->is_online,
            'is_active' => $this->is_active,
            'role' => $this->role,
            'rate' => $this->rate,
            'rate_count' => $this->rate_count,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
        ]);

        $query->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'dob', $this->dob])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'weight', $this->weight])
            ->andFilterWhere(['like', 'height', $this->height])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'card_number', $this->card_number])
            ->andFilterWhere(['like', 'card_cvv', $this->card_cvv])
            ->andFilterWhere(['like', 'card_exp', $this->card_exp])
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'long', $this->long])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
    
    // added 4:15pm 21/8/19
    public function searchSeller($params)
    {
        // seller la nhung nguoi co mat trong product_deal
        $id_seller = ProductDeal::find()
            ->select(['product_deal.seller_id'])
            ->groupBy('product_deal.seller_id')
            ->all();

        $arr_id = array();

        foreach($id_seller as $id)
        {
            $arr_id[] = $id->seller_id;
        }

        $query = AppUser::find()->where(['IN','id',$arr_id]);

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
            'qb_id' => $this->qb_id,
            'balance' => $this->balance,
            'point' => $this->point,
            'is_online' => $this->is_online,
            'is_active' => $this->is_active,
            'role' => $this->role,
            'rate' => $this->rate,
            'rate_count' => $this->rate_count,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
        ]);

        $query->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'dob', $this->dob])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'weight', $this->weight])
            ->andFilterWhere(['like', 'height', $this->height])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'card_number', $this->card_number])
            ->andFilterWhere(['like', 'card_cvv', $this->card_cvv])
            ->andFilterWhere(['like', 'card_exp', $this->card_exp])
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'long', $this->long])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

    public function searchBuyer($params)
    {
        // buyer la nhung nguoi co mat trong order
        $id_buyer = Order::find()
            ->select(['order.user_id'])
            ->groupBy('order.user_id')
            ->all();

        $arr_id = array();

        foreach($id_buyer as $id)
        {
            $arr_id[] = $id->user_id;
        }

        $query = AppUser::find()->where(['IN','id',$arr_id]);

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
            'qb_id' => $this->qb_id,
            'balance' => $this->balance,
            'point' => $this->point,
            'is_online' => $this->is_online,
            'is_active' => $this->is_active,
            'role' => $this->role,
            'rate' => $this->rate,
            'rate_count' => $this->rate_count,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
        ]);

        $query->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'dob', $this->dob])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'weight', $this->weight])
            ->andFilterWhere(['like', 'height', $this->height])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'card_number', $this->card_number])
            ->andFilterWhere(['like', 'card_cvv', $this->card_cvv])
            ->andFilterWhere(['like', 'card_exp', $this->card_exp])
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'long', $this->long])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
    //end added 4:15pm 21/8/19
}
