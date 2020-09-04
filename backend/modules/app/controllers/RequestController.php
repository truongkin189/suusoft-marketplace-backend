<?php

namespace backend\modules\app\controllers;

use backend\modules\app\models\AppUserAPI;
use backend\modules\app\models\AppUserTransactionAPI;
use backend\modules\app\models\AppUserTransactionRequestBase;
use Yii;
use backend\modules\app\models\AppUserTransactionRequest;
use backend\modules\app\models\AppUserTransactionRequestSearch;
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


/**
 * RequestController implements the CRUD actions for AppUserTransactionRequest model.
 */
class RequestController extends BackendController
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
     * Lists all AppUserTransactionRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AppUserTransactionRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $Id = Yii::$app->request->post('editableKey');

            $model = AppUserTransactionRequest::findOne($Id);

            // store a default json response as desired by editable
            $out = Json::encode(['output' => '', 'message' => '']);

            // fetch the first entry in posted data (there should
            // only be one entry anyway in this array for an
            // editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
            $post = [];
            $posted = current($_POST['AppUserTransactionRequest']);
            $post['AppUserTransactionRequest'] = $posted;

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
     * Displays a single AppUserTransactionRequest model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);


        if ($request->isAjax) {

            if ($model->status == 0) {
                $footer = Html::a('Approve', ['approve', 'id' => $id], ['class' => 'btn btn-success pull-left', 'role' => 'modal-remote']) .
                    Html::a('Reject', ['reject', 'id' => $id], ['class' => 'btn btn-danger pull-left', 'role' => 'modal-remote']) .
                    Html::button('Close', ['class' => 'btn btn-default', 'data-dismiss' => "modal"]);
            } else {
                $footer = Html::button('Close', ['class' => 'btn btn-default', 'data-dismiss' => "modal"]);
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "App User Transaction Request #" . $id,
                'content' => $this->renderPartial('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' =>
                    $footer
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionApprove($id)
    {
        $model = $this->findModel($id);
        $request = Yii::$app->request;

        $user_id = $model->user_id;
        $user = AppUserAPI::findOne($user_id);
        
        // model appUserTransactionRequest
        $model->status = 1;
        $amount = $model->amount;

        if ($user->balance > $amount) {
            if ($model->type == AppUserTransactionRequestBase::TYPE_REDEEM) {
                $msg = Yii::t('common', 'push.redeem.approved');
                $now = time();
                $today = date('Y-m-d H:i:s', $now);

                $user->balance = $user->balance - $amount;
                if ($user->save()) {
                    $user_transaction = new AppUserTransactionAPI();
                    $user_transaction->transaction_id = \Globals::generateTransactionId($user_id);
                    $user_transaction->user_id = $user_id;
                    $user_transaction->user_visible = 1;
                    $user_transaction->destination_id = 0;
                    $user_transaction->currency = '';
                    $user_transaction->payment_method = 'point';
                    $user_transaction->time = time();
                    $user_transaction->amount = $amount;
                    $user_transaction->is_active = 1;
                    $user_transaction->action = AppUserTransactionAPI::ACTION_REDEEM_POINT;
                    $user_transaction->type = AppUserTransactionAPI::TYPE_MINUS;
                    $user_transaction->created_date = $today;
                    $user_transaction->created_user = 0;
                    $user_transaction->save();

                    $model->save();

                    $url = Yii::$app->urlManager->createAbsoluteUrl(['api/utility/pushNotification',
                        'msg' => $msg,
                        'user_id' => $user_id,
                        'type' => 'balance',
                        'additional_data' => $user_transaction->user->balance,
                    ]);

                    ignore_user_abort(true); // CAUTION!  run over return
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // comment when test
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
                    // thoi gan song cua CURL
                    curl_setopt($ch, CURLOPT_TIMEOUT, 1); // Skip receive return
                    curl_exec($ch);
                    curl_close($ch);

                } else {
                    var_dump($user->getErrors());
                    die;
                }
            }

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
        $model = $this->findModel($id);
        $request = Yii::$app->request;

        $model->status = -1;

        $msg = '';
        if ($model->type == AppUserTransactionRequestBase::TYPE_REDEEM) {
            $msg = Yii::t('common', 'push.redeem.reject');
        }
        //elseif ($model->type == AppUserTransactionRequestBase::TYPE_TRANSFER) {
        //    $msg = Yii::t('common', 'push.transfer.reject');
        //}

        if ($model->save()) {
            if (strlen($msg) != 0) {
                $url = Yii::$app->urlManager->createAbsoluteUrl(['api/utility/pushNotification',
                    'msg' => $msg,
                    'user_id' => $model->user_id,
                    'type' => 'system',
                    'additional_data' => '',
                ]);
                ignore_user_abort(true);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
                curl_setopt($ch, CURLOPT_TIMEOUT, 1);
                curl_exec($ch);
                curl_close($ch);
            }
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

    /**
     * Creates a new AppUserTransactionRequest model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new AppUserTransactionRequest();


        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new App User Transaction Request",
                    'content' => $this->renderPartial('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Create new App User Transaction Request",
                    'content' => '<span class="text-success">Create AppUserTransactionRequest success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "Create new App User Transaction Request",
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
                $model->created_date = date('Y-m-d H:i:s', $time_string);
                if ($model->save()) {

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
     * Updates an existing AppUserTransactionRequest model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);


        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update App User Transaction Request #" . $id,
                    'content' => $this->renderPartial('update', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "App User Transaction Request #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Update App User Transaction Request #" . $id,
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

                $time_string = time();
                $model->modified_date = date('Y-m-d H:i:s', $time_string);

                if ($model->save()) {


                    return $this->redirect(['index']);
                } else {
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
     * Delete an existing AppUserTransactionRequest model.
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
     * Delete multiple existing AppUserTransactionRequest model.
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
     * Finds the AppUserTransactionRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AppUserTransactionRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AppUserTransactionRequest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
