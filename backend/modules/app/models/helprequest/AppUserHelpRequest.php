<?php

namespace backend\modules\app\models\helprequest;

class AppUserHelpRequest extends AppUserHelpRequestBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
            [['topic', 'user_id', 'is_top', 'status'], 'integer'],
            [['question', 'answer'], 'required'],
            [['question', 'answer'], 'string'],
            [['created_at', 'modified_at'], 'safe'],                
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'topic' => 'Topic',
            'user_id' => 'User ID',
            'question' => 'Question',
            'answer' => 'Answer',
            'is_top' => 'Is Top',
            'status' => 'Status',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }
}
