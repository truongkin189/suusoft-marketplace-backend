<?php

namespace backend\modules\app\models;

class AppUserLogs extends AppUserLogsBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
            [['user_id'], 'required'],
            [['duration'], 'integer'],
            [['created_date', 'modified_date'], 'safe'],
            [['user_id', 'action', 'destination_id', 'application_id'], 'string', 'max' => 100],                
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'action' => 'Action',
            'duration' => 'Duration',
            'destination_id' => 'Destination ID',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
            'application_id' => 'Application ID',
        ];
    }
}
