<?php

namespace backend\modules\product\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\product\models\OrderDetail;

/**
 * OrderDetailSearch represents the model behind the search form about `backend\modules\product\models\OrderDetail`.
 */
class OrderDetailSearch extends OrderDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'orderId', 'productId', 'classId', 'quantity'], 'integer'],
            [['productName', 'class', 'startDate', 'endDate', 'schedule', 'color', 'size'], 'safe'],
            [['price', 'subTotal'], 'number'],
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
        $query = OrderDetail::find();

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
            'orderId' => $this->orderId,
            'productId' => $this->productId,
            'classId' => $this->classId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'subTotal' => $this->subTotal,
        ]);

        $query->andFilterWhere(['like', 'productName', $this->productName])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'schedule', $this->schedule])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'size', $this->size]);

        return $dataProvider;
    }
}
