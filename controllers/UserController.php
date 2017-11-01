<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\helpers\FileHelper;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\ChangePasswordForm; 
use app\models\EditProfileForm;
use app\models\User;
use yii\web\UploadedFile;

class UserController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //apply this security check to all actions in this controller
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],   //only authenticated users can execute all actions in this controller
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    //unauthenticated user
                    Yii::$app->session->setFlash('dangerFlash', 
                            "<h4><i>Login required!!</i></h4>
                            The requested page can only be accessed by authenticated users for security reasons.<br />
                            Your log in session has either expired or you didn't log in at all. Please log in to continue
                            enjoying " . Yii::$app->name . ".<br />Thanks.");
                    return Yii::$app->controller->redirect(Url::to(['site/login']));
                }
            ],
        ];
    }

    /* This before action is to make sure that the user is a user for real */
    /*public function beforeAction($action){
        if(!Yii::$app->user->isGuest){
            if(Yii::$app->user->identity->userType !== 'A'){
                return  parent::beforeAction($action);
            }
            return Yii::$app->controller->redirect(Url::to(['site/error',
                'name' => 'Unauthorized (#401)',
                'message' => 'You are NOT authorized to access this page! Only for ' . Yii::$app->name . ' users',
            ]));
        }
    }*/

    public function actionIndex(){
        return $this->render('index');
    }
    
    /**
     * changes a user's password.
     *
     * @return string
    */
    public function actionChangePass(){
        $changePasswordForm = new ChangePasswordForm();
        if ($changePasswordForm->load(Yii::$app->request->post()) && $changePasswordForm->validate()) {
            $user = User::findOne(['userId' => Yii::$app->user->identity->userId]);
            if(Yii::$app->getSecurity()->validatePassword($changePasswordForm->currentPassword, $user->password)){
                /* hash and update password */
                $user->password = Yii::$app->getSecurity()->generatePasswordHash($changePasswordForm->newPassword);
                if($user->save()){ //successful password change
                    //set a flash to this effect
                    Yii::$app->session->setFlash('successful');
                }
            }
            else{
                Yii::$app->session->setFlash('incorrectCurPass');
            }
        }
        return $this->render('change-pass', [
            'changePasswordForm' => $changePasswordForm,
        ]);
    }

    public function actionEditProfile(){
        $editProfileForm = new EditProfileForm();
        $userInfo = User::findOne(Yii::$app->user->identity->userId);
        if ($editProfileForm->load(Yii::$app->request->post()) && $editProfileForm->validate()) {
            /* Checking whether User already exist */
            $emailExist = User::find()
                            ->where(['email' => $editProfileForm->email])
                            ->andFilterWhere(['not like', 'email', Yii::$app->user->identity->email])
                            ->one();
            if($emailExist){
                Yii::$app->session->setFlash('exist', 
                        "Somebody already has the email address $emailExist->email in the system. "
                        . "Please change your email address if possible.");
                return $this->render('edit-profile', [
                    'editProfileForm' => $editProfileForm,
                    'userInfo' => $userInfo,
                ]);
            }
            $phoneExist = User::find()
                            ->where(['phone' => $editProfileForm->phone])
                            ->andFilterWhere(['not like', 'phone', Yii::$app->user->identity->phone])
                            ->one();
            if($phoneExist){
                Yii::$app->session->setFlash('exist', 
                        "Somebody already has the phone number $phoneExist->phone in the system. "
                        . "Please change your phone number if possible.");
                return $this->render('edit-profile', [
                    'editProfileForm' => $editProfileForm,
                    'userInfo' => $userInfo,
                ]);
            }
            
            //saving to User table
            $userInfo->name = $editProfileForm->name;
            $userInfo->email = $editProfileForm->email;
            $userInfo->country = $editProfileForm->country;
            $userInfo->phone = $editProfileForm->phone;
            if($userInfo->save()){
                //saving to Login table
                $loginInfo = Login::findOne(['User_userPrimary' => Yii::$app->user->identity->userPrimary]);
                $loginInfo->email = $editProfileForm->email;
                $loginInfo->phone = $editProfileForm->phone;
                if($loginInfo->save()){
                    //saving the profile pic if it was uploaded
                    $file = UploadedFile::getInstance($editProfileForm, 'profilePic');
                    if($file){  //user selected a file
                        $path = "profilePics";
                        FileHelper::createDirectory($path, $mode = 0777, $recursive = true);
                        if(file_exists(Yii::$app->basePath . "/web/$path/$userInfo->userUrl") && 
                                is_file(Yii::$app->basePath . "/web/$path/$userInfo->userUrl")){
                            //update scennario
                            unlink(Yii::$app->basePath . "/web/$path/$userInfo->userUrl");  //delete file 
                            //save new file now
                            $file->saveAs("$path/$userInfo->userUrl");
                        }
                        else{
                            //insert scenario
                            $file->saveAs("$path/$userInfo->userUrl");
                        }
                    }
                    Yii::$app->session->setFlash('editSuccess'); 
                    return $this->render('edit-profile', [
                        'editProfileForm' => $editProfileForm,
                        'userInfo' => $userInfo,
                    ]);
                }
            }
            //system error occured
            Yii::$app->session->setFlash('editFail');
        }
        return $this->render('edit-profile', [
            'editProfileForm' => $editProfileForm,
        ]);
    }

}
