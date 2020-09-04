<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\ChangePasswordForm;
use backend\modules\app\models\AppUserAPI;
use backend\modules\app\models\AppUserBase;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionChangePassword()
    {
        $this->layout = 'frontend-form';

        $model = new ChangePasswordForm();
        if ($model->load(Yii::$app->request->post())) {

            $newPassword = $_POST['ChangePasswordForm']['newPassword'];

            if ($model->validate()) {
                $user = AppUserAPI::find()->where('email ="' . $model->email . '"')->one();
                /* @var  AppUserAPI $user*/
                if (isset($user)) {
                    if ($user->password_reset_token == $model->token) {
                        $hash = Yii::$app->getSecurity()->generatePasswordHash($newPassword);
                        if (Yii::$app->getSecurity()->validatePassword($newPassword, $hash)) {
                            $user->setPassword($newPassword);

                            if ($user->save()) {
                                $user->password_reset_token = null;
                                $user->save();
                                Yii::$app->session->setFlash('success', 'Password has been changed.');
                            } else {
                                Yii::$app->session->setFlash('error', 'Can not save.');
                            }
                        } else {
                            Yii::$app->session->setFlash('error', 'New password invalid');
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'Token mismatch.');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Account does not exist.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'An error occur.');
            }
        }

        return $this->render('change-password', [
            'model' => $model,
        ]);
    }
    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionConfirmRegistration($email, $token)
    {
        $this->layout = 'frontend-notice';
        $checkEmail = AppUserBase::find()->where("email = '" . $email . "'")->one();
        if (isset($checkEmail)) {
            if ($checkEmail->password_reset_token != $token) {
                if (strlen($checkEmail->password_reset_token) == 0 && $checkEmail->is_active == 1) {
                    $message = 'Your account is already activated. Thank you for using our services';
                } else {
                    $message = 'Token mismatch';
                }
            } else {
                $checkEmail->password_reset_token = null;
                $checkEmail->is_active = 1;
                $checkEmail->save();

                $message = 'Your account has been activated. Thank you for using our services';
            }
        } else {
            $message = 'Your account does not exist';
        }
        return $this->render('confirm-registration', [
            'message' => $message,
        ]);
    }
}
