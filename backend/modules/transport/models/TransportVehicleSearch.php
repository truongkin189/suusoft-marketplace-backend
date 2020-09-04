<?php

namespace backend\modules\transport\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\transport\models\TransportVehicle;

/**
 * TransportVehicleSearch represents the model behind the search form about `backend\modules\transport\models\TransportVehicle`.
 */
class TransportVehicleSearch extends TransportVehicle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'yearly_km', 'yearly_insurance', 'yearly_maintenance', 'yearly_tax', 'yearly_gara', 'yearly_unexpected', 'year_intend', 'price_4_new_tyres', 'sold_value', 'bought_value'], 'integer'],
            [['image', 'permit', 'insurance', 'fuel_type', 'plate', 'brand', 'model', 'color', 'year', 'status', 'description', 'created_date', 'modified_date'], 'safe'],
            [['average_consumption', 'fuel_unit_price'], 'number'],
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
        $query = TransportVehicle::find();

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
            'user_id' => $this->user_id,
            'yearly_km' => $this->yearly_km,
            'yearly_insurance' => $this->yearly_insurance,
            'yearly_maintenance' => $this->yearly_maintenance,
            'yearly_tax' => $this->yearly_tax,
            'yearly_gara' => $this->yearly_gara,
            'yearly_unexpected' => $this->yearly_unexpected,
            'year_intend' => $this->year_intend,
            'price_4_new_tyres' => $this->price_4_new_tyres,
            'average_consumption' => $this->average_consumption,
            'fuel_unit_price' => $this->fuel_unit_price,
            'sold_value' => $this->sold_value,
            'bought_value' => $this->bought_value,
            'year' => $this->year,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
        ]);

        $query->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'permit', $this->permit])
            ->andFilterWhere(['like', 'insurance', $this->insurance])
            ->andFilterWhere(['like', 'fuel_type', $this->fuel_type])
            ->andFilterWhere(['like', 'plate', $this->plate])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
