<?php

namespace backend\modules\app\models;

use backend\modules\product\models\ProductDealAPI;
use backend\modules\transport\models\TransportTripAPI;
use Yii;
use common\components\FHtml;
use yii\helpers\ArrayHelper;

/**
 * Developed by Hung Ho (Steve): hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
 * Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
 * MOZA TECH Inc: www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the customized model class for table "app_user_review".
 *
 * @property AppUserAPI $author
 * @property AppUserAPI $destination
 * @property AppUserProAPI $destinationPro
 * @property TransportTripAPI $objectTrip
 * @property ProductDealAPI $objectDeal
 */
class AppUserReviewAPI extends AppUserReviewBase
{
    public $author_avatar;
    public $author_name;
    public $object_rate;
    public $object_rate_count;

    public function fields()
    {
        $fields = parent::fields();
        //$fields = array_merge($fields, ['author']);
        $fields = array_merge($fields, ['author_avatar', 'author_name', 'object_rate', 'object_rate_count']);
        if(isset($this->author)){
            if (filter_var($this->author->avatar, FILTER_VALIDATE_URL)) {
                $avatar_link =  $this->author->avatar;
            }else{
                if(!isset($this->author->avatar) || strlen($this->author->avatar) == 0){
                    $avatar_link = "";
                }else{
                    $avatar_link = Yii::$app->urlManager->createAbsoluteUrl(['api/file', 'f'=> $this->author->avatar, 'd' => APP_USER_DIR, 's'=>'thumb']);
                }
            }
            $this->author_avatar = $avatar_link;
            $this->author_name = $this->author->name;
        }
        return $fields;
    }

    public function rules()
    {
        return [];
    }

    public function getDestination()
    {
        return $this->hasOne(AppUserAPI::className(), ['id' => 'destination_id']);
    }

    public function getDestinationPro()
    {
        return $this->hasOne(AppUserProAPI::className(), ['user_id' => 'destination_id']);
    }

    public function getAuthor()
    {
        return $this->hasOne(AppUserAPI::className(), ['id' => 'author_id']);
    }

    public function getObjectDeal()
    {
        return $this->hasOne(ProductDealAPI::className(), ['id' => 'object_id']);
    }

    public function getObjectTrip()
    {
        return $this->hasOne(TransportTripAPI::className(), ['id' => 'object_id']);
    }

}
