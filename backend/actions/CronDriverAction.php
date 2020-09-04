<?php
namespace backend\actions;

use Yii;
set_time_limit(0);


class CronDriverAction extends BaseAction
{
    public function run()
    {
        $now = time();
        Yii::$app->db->createCommand("UPDATE transport_driver SET is_online = 0, online_started = NULL , online_duration= NULL
WHERE (online_started + (3600*online_duration)) < :now")
            ->bindValue(':now', $now)
            ->execute();


    }
}
