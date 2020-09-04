<?php

namespace backend\modules\product\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\product\models\Order;

/**
 * OrderSearch represents the model behind the search form about `backend\modules\product\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'status_user', 'user_id'], 'integer'],
            [['billingName', 'billingPhone', 'billingAddress', 'billingEmail', 'billingPostcode', 'shippingName', 'shippingPhone', 'shippingAddress', 'shippingEmail', 'shippingPostcode', 'paymentMethod', 'content', 'transportDes', 'transportType', 'type_product', 'token_payment', 'createDate'], 'safe'],
            [['total', 'vat', 'transportFee'], 'number'],
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
    public function search($params,$type = '')
    {
        // $query = Order::find();

        if ($type == '') {
            $query = Order::find()->orderBy('createDate DESC');
        }else{
            $query = Order::find()->where('status = '. $type)->orderBy('createDate DESC');
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
            'status' => $this->status,
            'status_user' => $this->status_user,
            'total' => $this->total,
            'vat' => $this->vat,
            'transportFee' => $this->transportFee,
            'user_id' => $this->user_id,
            'createDate' => $this->createDate,
        ]);

        $query->andFilterWhere(['like', 'billingName', $this->billingName])
            ->andFilterWhere(['like', 'billingPhone', $this->billingPhone])
            ->andFilterWhere(['like', 'billingAddress', $this->billingAddress])
            ->andFilterWhere(['like', 'billingEmail', $this->billingEmail])
            ->andFilterWhere(['like', 'billingPostcode', $this->billingPostcode])
            ->andFilterWhere(['like', 'shippingName', $this->shippingName])
            ->andFilterWhere(['like', 'shippingPhone', $this->shippingPhone])
            ->andFilterWhere(['like', 'shippingAddress', $this->shippingAddress])
            ->andFilterWhere(['like', 'shippingEmail', $this->shippingEmail])
            ->andFilterWhere(['like', 'shippingPostcode', $this->shippingPostcode])
            ->andFilterWhere(['like', 'paymentMethod', $this->paymentMethod])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'transportDes', $this->transportDes])
            ->andFilterWhere(['like', 'transportType', $this->transportType])
            ->andFilterWhere(['like', 'type_product', $this->type_product])
            ->andFilterWhere(['like', 'token_payment', $this->token_payment]);

        return $dataProvider;
    }
}
