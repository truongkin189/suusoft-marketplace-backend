<?php

namespace backend\controllers;
use backend\models\Setting;
use backend\models\SettingForm;
use Yii;
use yii\web\UploadedFile;
use common\models\PasswordForm;
use common\models\User;


class SettingController extends BackendController
{


    public function actionIndex()
    {

        $model = new SettingForm();
        $model->loadModel();

        $oldPem = $model->pem;


        if(isset($_POST['SettingForm'])){
            $model->attributes = $_POST['SettingForm'];
            $uploadedFile = UploadedFile::getInstance($model, 'pem');
            
            $banner_1_uploaded_file = UploadedFile::getInstance($model, 'banner_file_1');
            $banner_2_uploaded_file = UploadedFile::getInstance($model, 'banner_file_2');
            $banner_3_uploaded_file = UploadedFile::getInstance($model, 'banner_file_3');
            $banner_4_uploaded_file = UploadedFile::getInstance($model, 'banner_file_4');

            if($model->validate()) {

                if ($uploadedFile && $uploadedFile->size > 0) {
                    $name_file = time().'.'.$uploadedFile->extension;
                    $model->pem = $name_file;
                }
                else
                    $model->pem = $oldPem;
                
                if ($uploadedFile && $uploadedFile->size > 0) {
                    $uploadFolder = $this->uploadFolder . DIRECTORY_SEPARATOR . PEM_DIR;

                    if (!file_exists($uploadFolder)) {
                        mkdir($uploadFolder, 0777, true);
                    }
                    $uploadedFile->saveAs($uploadFolder . DIRECTORY_SEPARATOR . $model->pem);  // image
                    $oldPath = $uploadFolder . DIRECTORY_SEPARATOR . $oldPem;
                    if (file_exists($oldPath) && is_file($oldPath)) {
                        unlink($oldPath);
                    }
                }
                
                $time_string = time();

                for($i = 1; $i <= 4; $i++)
                {
                    if(${'banner_'. $i . '_uploaded_file'})
                    {
                        $model->{'image_banner_' . $i} = $time_string . rand(0, 1000) . '_image_banner_' . $i . '.' . ${'banner_' . $i . '_uploaded_file'}->extension;
                    }
                }
                
                if($model->save())
                {
                    for($i = 1; $i <= 4; $i++)
                    {
                        if(${'banner_'. $i . '_uploaded_file'})
                        {
                            $avatar_path = $this->uploadFolder . '/banner/' . $model->{'image_banner_' . $i};
                            ${'banner_'. $i . '_uploaded_file'}->saveAs($avatar_path);
                        }
                    }
                }
            }
        }

        return $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionChangePassword(){

        $model = new PasswordForm;
        $modeluser = User::find()->where([
            'username'=>Yii::$app->user->identity->username
        ])->one();
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                try{
                    $modeluser->password_hash = Yii::$app->getSecurity()->generatePasswordHash($model->newPass);
                    if($modeluser->save()){
                        Yii::$app->getSession()->setFlash(
                            'success','Password changed'
                        );
                        Yii::$app->user->logout();
                        return $this->redirect(['site/login']);
                    }else{
                        Yii::$app->getSession()->setFlash(
                            'error','Password not changed'
                        );
                        return $this->redirect(['change-password']);
                    }
                }catch(\Exception $e){
                    Yii::$app->getSession()->setFlash(
                        'error',"{$e->getMessage()}"
                    );
                    return $this->render('change-password',[
                        'model'=>$model
                    ]);
                }
            }else{
                return $this->render('change-password',[
                    'model'=>$model
                ]);
            }
        }else{
            return $this->render('change-password',[
                'model'=>$model
            ]);
        }
        
    }

    public function actionFaq()
    {
        $faq = Setting::getSettingValueByKey(\Globals::PAGE_FAQ);
        echo $faq;
    }

    public function actionAbout()
    {
        $faq = Setting::getSettingValueByKey(\Globals::PAGE_ABOUT);
        echo $faq;
    }

    public function actionHelp()
    {
        $faq = Setting::getSettingValueByKey(\Globals::PAGE_HELP);
        echo $faq;
    }

    public function actionTerm()
    {
        $faq = Setting::getSettingValueByKey(\Globals::PAGE_TERM);
        echo $faq;
    }

}
