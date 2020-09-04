<?php

namespace backend\modules\app\controllers;

use Yii;
use backend\modules\app\models\AppUser;
use backend\modules\app\models\AppUserProAPI;
use backend\modules\app\models\AppUserSearch;
use backend\modules\app\models\AppUserTransactionAPI;

use backend\modules\product\models\ProductDeal;
use backend\modules\product\models\ProductDealImage;
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
use yii\web\UploadedFile;
use yii\imagine\Image;


/**
 * AppUserController implements the CRUD actions for AppUser model.
 */
class AppUserController extends BackendController
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
     * Lists all AppUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AppUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $Id = Yii::$app->request->post('editableKey');

            $model = AppUser::findOne($Id);

            // store a default json response as desired by editable
            $out = Json::encode(['output' => '', 'message' => '']);

            // fetch the first entry in posted data (there should
            // only be one entry anyway in this array for an
            // editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
            $post = [];
            $posted = current($_POST['AppUser']);
            $post['AppUser'] = $posted;

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
     * Displays a single AppUser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $pro_model = $model->pro;


        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "App User #" . $id,
                'content' => $this->renderPartial('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary pull-left', 'role' => $this->view->params['displayType']]) .
                    Html::button('Close', ['class' => 'btn btn-default', 'data-dismiss' => "modal"])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
                'pro_model' => $pro_model
            ]);
        }
    }
    
    /**
     * Lists all seller.
     * @return mixed
     */
    public function actionUser()
    {
        $searchModel = new AppUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all seller.
     * @return mixed
     */
    public function actionSeller()
    {
        $searchModel = new AppUserSearch();
        $dataProvider = $searchModel->searchSeller(Yii::$app->request->queryParams);

        // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $Id = Yii::$app->request->post('editableKey');

            $model = Order::findOne($Id);

            // store a default json response as desired by editable
            $out = Json::encode(['output' => '', 'message' => '']);

            // fetch the first entry in posted data (there should
            // only be one entry anyway in this array for an
            // editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
            $post = [];
            $posted = current($_POST['product']);
            $post['product'] = $posted;

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
           
            return;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all seller.
     * @return mixed
     */
    public function actionBuyer()
    {
        $searchModel = new AppUserSearch();
        $dataProvider = $searchModel->searchBuyer(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new AppUser model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new AppUser();


        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new App User",
                    'content' => $this->renderPartial('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Create new App User",
                    'content' => '<span class="text-success">Create AppUser success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "Create new App User",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                $time_string = time();
                $avatar_file = UploadedFile::getInstance($model, 'avatar_file');
                if ($avatar_file) {
                    $model->avatar = $time_string . rand(0, 1000) . '_app_user_avatar.' . $avatar_file->extension;
                }
                $model->created_date = date('Y-m-d H:i:s', $time_string);
                if ($model->save()) {
                    if ($avatar_file) {
                        $avatar_path = $this->uploadFolder . '/app-user/' . $model->avatar;
                        $avatar_file->saveAs($avatar_path);
                    }

                    return $this->redirect(['index']);
                } else {
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
     * Updates an existing AppUser model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        $avatar_old = $model->avatar;


        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update App User #" . $id,
                    'content' => $this->renderPartial('update', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "App User #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Update App User #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                // cmt 24/8
                // $time_string = time();
                // $avatar_file = UploadedFile::getInstance($model, 'avatar_file');
                // if ($avatar_file) {
                //     if (isset($avatar_old)) {
                //         if (is_file($this->uploadFolder . '/app-user/' . $avatar_old)) {
                //             unlink($this->uploadFolder . '/app-user/' . $avatar_old);
                //         }
                //     }
                //     $model->avatar = $time_string . rand(0, 1000) . '_app_user_avatar.' . $avatar_file->extension;
                // }
                // $model->modified_date = date('Y-m-d H:i:s', $time_string);
                // end 24/8

                $model->balance += $model->money_admin_transfer;

                if ($model->save(false)) {
                    $now = time();
                    $today = date('Y-m-d H:i:s', $now);

                    $transaction = new AppUserTransactionAPI();
                    $transaction->transaction_id = \Globals::generateTransactionId(6);
                    $transaction->user_id = 6;
                    $transaction->user_visible = 1;
                    $transaction->destination_id = $id;
                    // $transaction->object_id = $deal->id;
                    $transaction->object_type = 'Admin transfer';
                    $transaction->amount = $model->money_admin_transfer;
                    $transaction->currency = 'point';
                    $transaction->payment_method = AppUserTransactionAPI::PAYMENT_METHOD_POINT;
                    $transaction->time = $now;
                    $transaction->is_active = 1;
                    $transaction->action = AppUserTransactionAPI::ACTION_DEAL_ONLINE;
                    $transaction->type = AppUserTransactionAPI::TYPE_PLUS;
                    $transaction->created_date = $today;
                    $transaction->created_user = 6;
                    $transaction->save();
                    
                    // push
                        $url = Yii::$app->urlManager->createAbsoluteUrl(['api/utility/pushNotificationMarket',
                        'msg' => 'Your balance is changed',
                        'destination_id' => $id,
                        // empty
                        'additional_data' => $model->balance,
                        ]);
                        // CURL init
                        $ch = curl_init();
                        // CURL config
                        curl_setopt($ch, CURLOPT_URL, $url);
                        // CURL run
                        curl_exec($ch);
                        // CURL close
                        curl_close($ch);
                    // end push

                    // cmt 24/8/19
                    // if ($avatar_file) {
                    //     $avatar_path = $this->uploadFolder . '/app-user/' . $model->avatar;
                    //     $avatar_file->saveAs($avatar_path);
                    // }
                    // end

                    return $this->redirect(['index']);
                } else {
                    
                    // return $model->getErrors();
                    
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
     * Delete an existing AppUser model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $avatar_old = $model->avatar;
        if (strlen($avatar_old) > 0) {
            if (is_file($this->uploadFolder . '/app-user/' . $avatar_old)) {
                unlink($this->uploadFolder . '/app-user/' . $avatar_old);
            }
        }

        if($model->delete())
        {
            AppUserProAPI::findOne(['user_id'=>$id])->delete();
            
            $arr_img = ProductDeal::find('id')->where(['seller_id' => $id])->all();
            
            foreach($arr_img as $item)
            {
                $arr[] = $item->id;
            }
            
            ProductDealImage::deleteAll(['IN','product_deal_id',$arr]);
            
            ProductDeal::deleteAll(['seller_id' => $id]);
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

    /**
     * Delete multiple existing AppUser model.
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
            $avatar_old = $model->avatar;
            if (strlen($avatar_old) > 0) {
                if (is_file($this->uploadFolder . '/app-user/' . $avatar_old)) {
                    unlink($this->uploadFolder . '/app-user/' . $avatar_old);
                }
            }
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
                if ($action == FHtml::CLEAR_TYPE) {
                    $model[$field] = 0;
                    $model->save();
                }
                if ($action == FHtml::FILL_TYPE) {
                    $model[$field] = rand(0, 99999);
                    $model->save();
                }
                //do something with other actions
            }
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


    /**
     * Finds the AppUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AppUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AppUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
