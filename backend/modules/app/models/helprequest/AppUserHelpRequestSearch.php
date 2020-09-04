<?php

namespace backend\modules\app\models\helprequest;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\app\models\helprequest\AppUserHelpRequest;

/**
 * AppUserHelpRequestSearch represents the model behind the search form about `backend\modules\app\models\helprequest\AppUserHelpRequest`.
 */
class AppUserHelpRequestSearch extends AppUserHelpRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'topic', 'user_id', 'is_top', 'status'], 'integer'],
            [['question', 'answer', 'created_at', 'modified_at'], 'safe'],
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
        $query = AppUserHelpRequest::find();

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
            'topic' => $this->topic,
            'user_id' => $this->user_id,
            'is_top' => $this->is_top,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'modified_at' => $this->modified_at,
        ]);

        $query->andFilterWhere(['like', 'question', $this->question])
            ->andFilterWhere(['like', 'answer', $this->answer]);

        return $dataProvider;
    }
}
