<?php

namespace backend\modules\app\models\invitecode;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\app\models\invitecode\AppUserInviteCode;

/**
 * AppUserInviteCodeSearch represents the model behind the search form about `backend\modules\app\models\invitecode\AppUserInviteCode`.
 */
class AppUserInviteCodeSearch extends AppUserInviteCode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status'], 'integer'],
            [['invite_code', 'created_at'], 'safe'],
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
        $query = AppUserInviteCode::find();

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
            'created_at' => $this->created_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'invite_code', $this->invite_code]);

        return $dataProvider;
    }
}
