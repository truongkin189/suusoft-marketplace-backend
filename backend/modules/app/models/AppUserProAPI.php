<?php

namespace backend\modules\app\models;

use Yii;
use common\components\FHtml;
use yii\helpers\ArrayHelper;

/**
 * @property AppUserReviewAPI[] $toMeReviews
 */
class AppUserProAPI extends AppUserProBase
{
    public function fields()
    {
        $fields = parent::fields();

        return $fields;
    }

    public function rules()
    {
        return [];
    }

    public function getToMeReviews()
    {
        return $this->hasMany(AppUserReviewAPI::className(), ['destination_id' => 'user_id'])
            ->andOnCondition(['or',
                ['destination_role' => \Globals::ROLE_SELLER],
                ['destination_role' => \Globals::ROLE_DRIVER]
            ]);
    }
}
