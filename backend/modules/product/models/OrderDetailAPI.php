<?php

namespace backend\modules\product\models;

// 11:19 17/8
use backend\modules\product\models\OrderBase;
use backend\modules\product\models\OrderAPI;
use backend\modules\app\models\AppUserAPI_few;
use backend\modules\app\models\AppUserAPI;
use backend\modules\product\models\ProductDealAPI;
use backend\modules\product\models\ProductDealImageAPI;

class OrderDetailAPI extends OrderDetailBase
{
    public $order_status;
    public $order_info;
    public $seller_id;
    public $buyer_info;
    public $product_info;
    
    public function fields()
    {
        $fields = parent::fields();
        
        // $fields = [
        //     'id',
        //     'orderId',
        //     'productId',
        //     'productName',
        //     'classId',
        //     'class',
        //     'startDate',
        //     'endDate',
        //     'schedule',
        //     'quantity',
        //     'price',
        //     'subTotal',
        //     'color',
        //     'size',
        //     'created_at',
        // ];
        
        // tim seller_id trong prduct_deal theo orderId 3:40pm 26/8/19
        $this->seller_id = AppUserAPI_few::find()
            // ->select(['product_deal.seller_id'])
            ->innerJoin('product_deal', 'app_user.id = product_deal.seller_id')
            ->innerJoin('order_detail','order_detail.productId = product_deal.id')
            ->innerJoin('order', 'order.id = order_detail.orderId')
            ->where(['order.id' => $this->orderId])
            ->andWhere(['product_deal.id' => $this->productId])
            ->all();
            
        // tim buyer info 26/8
        $this->buyer_info = AppUserAPI_few::find()
            ->innerJoin('order', 'order.user_id = app_user.id')
            ->where(['order.id' => $this->orderId])
            ->all();
        
        $this->order_status = OrderAPI::findOne(['id' => $this->orderId])->status;
            
        // product info 26/8
        $this->product_info = ProductDealAPI::find()
            ->innerJoin('product_deal_image', 'product_deal_image.product_deal_id = product_deal.id')
            ->innerJoin('order_detail', 'order_detail.productId = product_deal.id')
            ->where(['order_detail.productId' => $this->productId])
            ->all();
            
        $this->order_info = OrderAPI::findOne(['id' => $this->orderId]);

        return array_merge($fields,['order_status','order_info','seller_id','buyer_info','product_info']);
    }

    public function rules()
    {
        return [];
    }
}
