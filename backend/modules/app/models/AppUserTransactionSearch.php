<?php

namespace backend\modules\app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\app\models\AppUserTransaction;

/**
 * AppUserTransactionSearch represents the model behind the search form about `backend\modules\app\models\AppUserTransaction`.
 */
class AppUserTransactionSearch extends AppUserTransaction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'user_visible', 'destination_id', 'destination_visible'], 'integer'],
            [['transaction_id', 'object_id', 'object_type', 'currency', 'payment_method', 'note', 'time', 'action', 'type', 'is_active', 'created_date', 'created_user', 'modified_date', 'modified_user', 'application_id'], 'safe'],
            [['amount'], 'number'],
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
        $query = AppUserTransaction::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['time'=>SORT_DESC]]
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
            'user_visible' => $this->user_visible,
            'destination_id' => $this->destination_id,
            'destination_visible' => $this->destination_visible,
            'amount' => $this->amount,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
        ]);

        $query->andFilterWhere(['like', 'transaction_id', $this->transaction_id])
            ->andFilterWhere(['like', 'object_id', $this->object_id])
            ->andFilterWhere(['like', 'object_type', $this->object_type])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'payment_method', $this->payment_method])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'action', $this->action])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'created_user', $this->created_user])
            ->andFilterWhere(['like', 'modified_user', $this->modified_user])
            ->andFilterWhere(['like', 'application_id', $this->application_id]);

        return $dataProvider;
    }
}
