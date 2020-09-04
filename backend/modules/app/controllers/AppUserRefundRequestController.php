<?php

namespace backend\modules\app\controllers;

use Yii;
use backend\modules\app\models\appuserrefund\AppUserRefundRequest;
use backend\modules\app\models\appuserrefund\AppUserRefundRequestSearch;
use backend\modules\app\models\AppUserAPI;
use backend\modules\app\models\AppUserTransactionAPI;
//use yii\web\Controller;
use backend\controllers\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Json;
use common\components\AccessRule;
use common\models\User;
use yii\filters\AccessControl;
use common\components\FHtml;

//  4 status
/**
 * -1 rejected
 * 0 processing
 * 1 approved
 * 2 canceled
 */

/**
 * AppUserRefundRequestController implements the CRUD actions for AppUserRefundRequest model.
 */
class AppUserRefundRequestController extends BackendController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['create', 'update', 'delete', 'view', 'index'],
                'rules' => [
                    [
                        'actions' => ['view', 'index', 'create'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_USER,
                            User::ROLE_MODERATOR,
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_MODERATOR,
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_ADMIN
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all AppUserRefundRequest models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new AppUserRefundRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

           // validate if there is a editable input saved via AJAX
           if (Yii::$app->request->post('hasEditable')) {
               // instantiate your book model for saving
               $Id = Yii::$app->request->post('editableKey');

               $model = AppUserRefundRequest::findOne($Id);

               // store a default json response as desired by editable
               $out = Json::encode(['output' => '', 'message' => '']);

               // fetch the first entry in posted data (there should
               // only be one entry anyway in this array for an
               // editable submission)
               // - $posted is the posted data for Book without any indexes
               // - $post is the converted array for single model validation
               $post = [];
               $posted = current($_POST['AppUserRefundRequest']);
               $post['AppUserRefundRequest'] = $posted;

               // load model like any single model validation
               if ($model->load($post)) {
                   // can save model or do something before saving model
                   $model->save();

                   // custom output to return to be displayed as the editable grid cell
                   // data. Normally this is empty - whereby whatever value is edited by
                   // in the input by user is updated automatically.
                   $output = '';
                   // similarly you can check if the name attribute was posted as well
                   // if (isset($posted['name'])) {
                   //   $output =  ''; // process as you need
                   // }
                   $out = Json::encode(['output' => $output, 'message' => '']);
               }
               // return ajax json encoded response and exit
               echo $out;
               return;
           }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single AppUserRefundRequest model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if($request->isAjax){

            if ($model->status == 0) {
                $footer = Html::a('Approve', ['approve', 'id' => $id], ['class' => 'btn btn-success pull-left', 'role' => 'modal-remote']) .
                    Html::a('Reject', ['reject', 'id' => $id], ['class' => 'btn btn-danger pull-left', 'role' => 'modal-remote']) .
                    Html::button('Close', ['class' => 'btn btn-default', 'data-dismiss' => "modal"]);
            } else {
                $footer = Html::button('Close', ['class' => 'btn btn-default', 'data-dismiss' => "modal"]);
            }

            // Yii::$app->response->format = Response::FORMAT_JSON;
            // return [
            //         'title'=> "App User Refund Request #".$id,
            //         'content'=>$this->renderPartial('view', [
            //             'model' => $this->findModel($id),
            //         ]),
            //         'footer'=>Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary pull-left','role'=>$this->view->params['displayType']]).
            //                   Html::button('Close',['class'=>'btn btn-default','data-dismiss'=>"modal"])
            //     ];

                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'title' => "App User Refund Request #" . $id,
                    'content' => $this->renderPartial('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer' =>
                        $footer
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionApprove($id)
    {
        // request controller
        /**
         * Admin chap nhan refund chuyen sang bang appusertransaction 
         * dong thoi appuser->balance bi tru amout trong refund
         */

        $model = $this->findModel($id); //AppUserRefundRequest
        $request = Yii::$app->request;

        $amount = $model->amount;

        $buyer_id = $model->buyer_id;
        $buyer = AppUserAPI::findOne($buyer_id);

        // cong tien cho buyer

        $seller_id = $model->seller_id;
        $seller = AppUserAPI::findOne($seller_id);

        // tru tien cua seller
        // thieu transaction
            if($seller->balance > $amount)
            {
                $msg = Yii::t('common', 'push.redeem.approved'); //o dau vay
                $now = time();
                $today = date('Y-m-d H:i:s', $now);

                $seller->balance = $seller->balance - $amount;
                if ($seller->save()) {
                    $refund = AppUserRefundRequest::findOne($id);
                    $refund->status = 1;
                    $refund->save();

                    $seller_transaction = new AppUserTransactionAPI();
                    $seller_transaction->transaction_id = \Globals::generateTransactionId($seller_id);
                    $seller_transaction->user_id = $seller_id; // from user_id to destination_id
                    $seller_transaction->user_visible = 1; 
                    $seller_transaction->destination_id = $buyer_id; //money from seller to buyer
                    $seller_transaction->currency = '';
                    $seller_transaction->payment_method = AppUserTransactionAPI::PAYMENT_METHOD_POINT;
                    $seller_transaction->time = time();
                    $seller_transaction->amount = $amount;
                    $seller_transaction->is_active = 1;
                    $seller_transaction->action = AppUserTransactionAPI::ACTION_TRANSFER_POINT;
                    $seller_transaction->type = AppUserTransactionAPI::TYPE_MINUS;
                    $seller_transaction->created_date = $today;
                    $seller_transaction->created_user = 0;
                    $seller_transaction->save();

                    $url_to_seller = Yii::$app->urlManager
                        ->createAbsoluteUrl(['api/utility/pushNotificationMarket',
                        'msg' => 'The refund request to you is approved by admin. ' 
                        .  'Deducted from your balance ' . $amount,
                        'destination_id' => $model->seller_id,
                        // empty
                        'additional_data' => 'Your balance now: '. $seller->balance,
                    ]);

                    // CURL init
                    $ch2 = curl_init();
                    // CURL config
                    curl_setopt($ch2, CURLOPT_URL, $url_to_seller);
                    // CURL run
                    curl_exec($ch2);
                    // CURL close
                    curl_close($ch2);

                }
            }
            else
            {
                // seller am tien thi trang thai is_active = 0 tuc la bi khoa
            }

            $now = time();
            $today = date('Y-m-d H:i:s', $now);

            $buyer->balance = $buyer->balance + $amount;
            if ($buyer->save()) 
            {
                $url_to_seller = Yii::$app->urlManager
                    ->createAbsoluteUrl(['api/utility/pushNotificationMarket',
                    'msg' => 'The refund request to you is approved by admin. ' 
                    .  'Deducted from your balance ' . $amount,
                    'destination_id' => $model->buyer_id,
                    // empty
                    'additional_data' => 'Your balance now: '.$buyer->balance,
                ]);

                // CURL init
                $ch2 = curl_init();
                // CURL config
                curl_setopt($ch2, CURLOPT_URL, $url_to_seller);
                // CURL run
                curl_exec($ch2);
                // CURL close
                curl_close($ch2);

            }

            if ($request->isAjax) {
                /*
                *   Process for ajax request
                */
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
            } else {
                return $this->render('view', [
                    'model' => $this->findModel($id),
                ]);
            }
    }

    public function actionReject($id)
    {
        // request controller
        /**
         * thong bao toi seller va buyer thoi
         */
        // push từng buyer

        // $msg = $model->message;
        // msg l18n
        $request = Yii::$app->request;

        $model = $this->findModel($id); //AppUserRefundRequest

            $model->status = -1;

            if($model->save())
            {
                $url_to_buyer = Yii::$app->urlManager->createAbsoluteUrl(['api/utility/pushNotificationMarket',
                'msg' => 'Your refund request is rejected',
                'destination_id' => $model->buyer_id,
                // empty
                // 'additional_data' => $user_transaction->user->balance,
                ]);

                $url_to_seller = Yii::$app->urlManager->createAbsoluteUrl(['api/utility/pushNotificationMarket',
                    'msg' => 'The refund request to you is rejected by admin',
                    'destination_id' => $model->seller_id,
                    // empty
                    // 'additional_data' => $user_transaction->user->balance,
                ]);

                // CURL init
                $ch1 = curl_init();
                $ch2 = curl_init();
                // CURL config
                curl_setopt($ch1, CURLOPT_URL, $url_to_buyer);
                curl_setopt($ch2, CURLOPT_URL, $url_to_seller);
                // CURL run
                curl_exec($ch1);
                curl_exec($ch2);
                // CURL close
                curl_close($ch1);
                curl_close($ch2);

                return $this->redirect(['index']);
            }

            
        
    }


    /**
     * Creates a new AppUserRefundRequest model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new AppUserRefundRequest();  


        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new App User Refund Request",
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                'forceReload'=>'#crud-datatable-pjax',
                'title'=> "Create new App User Refund Request",
                'content'=>'<span class="text-success">Create AppUserRefundRequest success</span>',
                'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                ];
            }else{
            return [
            'title'=> "Create new App User Refund Request",
            'content'=>$this->renderAjax('create', [
            'model' => $model,
            ]),
            'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
            Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

            ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {

                $time_string = time();
                $model->created_at = date('Y-m-d H:i:s',$time_string);

                if($model->save()) {
                    
                    return $this->redirect(['index']);
                }else{
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing AppUserRefundRequest model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);



        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update App User Refund Request #".$id,
                    'content'=>$this->renderPartial('update', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "App User Refund Request #".$id,
                        'content'=>$this->renderAjax('view', [
                            'model' => $model,
                        ]),
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                    Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];
            }else{
                    return [
                        'title'=> "Update App User Refund Request #".$id,
                        'content'=>$this->renderAjax('update', [
                            'model' => $model,
                        ]),
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                    Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                    ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {

                                    
                if($model->save()) {

            
                    return $this->redirect(['index']);
                }else{
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing AppUserRefundRequest model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        $model->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing AppUserRefundRequest model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    public function actionBulkAction($action = '', $field = '', $value = '')
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            if (isset($model)) {
                if ($action == FHtml::CHANGE_TYPE) {
                    $model[$field] = $value;
                    $model->save();
                }
                if($action == FHtml::CLEAR_TYPE){
                    $model[$field] = 0;
                    $model->save();
                }
                if($action == FHtml::FILL_TYPE){
                    $model[$field] = rand(0,99999);
                    $model->save();
                }
                //do something with other actions
            }
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }


    /**
     * Finds the AppUserRefundRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AppUserRefundRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AppUserRefundRequest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
