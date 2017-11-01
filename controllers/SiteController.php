<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\ContactMessage;
use app\models\User;
use app\models\ActivateAccount;
use app\models\PasswordReset;
use app\models\PasswordResetForm;
use app\models\PasswordResetLinkForm;
use app\models\MailPasswordResetForm;
use yii\helpers\FileHelper;

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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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
     * @return string
     */
    public function actionIndex()
    {
        //logout the user if he/she is logged in
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }

        Yii::$app->session->setFlash('showLogin');
        return $this->showIndex();
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        //logout the user if he/she is logged in
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }

        Yii::$app->session->setFlash('showLogin');
        $loginForm = new LoginForm();
        if ($loginForm->load(Yii::$app->request->post()) && $loginForm->validate()) {
            /* Processing of Name/email/phone_number */
            $user = User::find()
                            ->where(['email' => $loginForm->login])
                            ->orWhere(['phoneNumber' => $loginForm->login])
                            ->one();
            if($user){    //user found in db
                //check if user's account is activated
                $isActivated = ActivateAccount::findOne($user->userId);
                if(!$isActivated->status){
                    return $this->render('error', [
                        'name' => 'Forbidden (#403)',
                        'message' => 'Your account is NOT activated. Please activate it form your email.',
                    ]);
                }
                
                if(Yii::$app->getSecurity()->validatePassword($loginForm->password, $user->password)){
                    Yii::$app->user->login($user);
                    if($user->userType == 'A')
                        return Yii::$app->controller->redirect(Url::to(['admin/index'])); 
                    else
                        return Yii::$app->controller->redirect(Url::to(['user/index'])); 

                }
            }
            //unknown user
            Yii::$app->session->setFlash('loginFail');
        }

        return $this->showIndex();
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact(){
        $contactForm = new ContactForm();
        $contactMessage = new ContactMessage();
        if ($contactForm->load(Yii::$app->request->post()) && $contactForm->validate()) {
            $contactMessage->name = $contactForm->name;
            $contactMessage->email = $contactForm->email;
            $contactMessage->subject = $contactForm->subject;
            $contactMessage->body = $contactForm->body;
            if($contactMessage->save())
                Yii::$app->session->setFlash('contactSuccess');
            else
                Yii::$app->session->setFlash('contactFail');
            return $this->render('contact', [
                'contactForm' => $contactForm,
            ]);
        }
        return $this->render('contact', [
            'contactForm' => $contactForm,
        ]);
    }

    public function actionSignup(){
        //logout the user if he/she is logged in
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();        }

        Yii::$app->session->setFlash('showSignup');
        $signupForm = new SignupForm();
        $user = new User();
        $activateAccount = new ActivateAccount();
        if ($signupForm->load(Yii::$app->request->post()) && $signupForm->validate()) {
            /* Checking whether User already exist */
            $emailExist = User::findOne(['email' => $signupForm->email]);
            if($emailExist){
                Yii::$app->session->setFlash('signupFail', 
                        "Somebody already has the email address $emailExist->email in the system. "
                        . "Please change your email address if possible.");
                return $this->showIndex();
            }

            $user->userName = $signupForm->userName;
            $user->email = $signupForm->email;
            $user->userType = $signupForm->userType;
            $nameStr = explode(' ', $signupForm->userName);
            $user->userUrl = implode('', $nameStr);
            /* Checking whether User already exist with this userUrl */
            $urlExist = User::findOne(['userUrl' => $user->userUrl]);
            if($urlExist)
                $user->userUrl = $user->userUrl . rand() % 100;
            $user->password = Yii::$app->getSecurity()->generatePasswordHash($signupForm->password);
            if($user->save()){
                $activateAccount->userId = $user->userId;
                $activateAccount->status = 0;
                $randomString1 = Yii::$app->getSecurity()->generateRandomString(15);
                $randomString2 = Yii::$app->getSecurity()->generateRandomString(15);
                $activateAccount->activateUrl = Url::to(['site/activate-account', 'id' => $randomString1,
                                                                        'twisup' => $user->userId, 'ded24twi'=>$randomString2], 'http');
                if($activateAccount->save()){
                    //send account activation mail
                    Yii::$app->mailer->compose('accountActivationMail', [
                            'name' => $user->userName, 'activateUrl' => $activateAccount->activateUrl])
                        ->setFrom(Yii::$app->params['adminEmail'])
                        ->setTo($user->email)
                        ->setSubject(Yii::$app->name . ' account activation')
                        ->send();
                    /* v to ensure that mail has been sent */
                    Yii::$app->session->setFlash('signupSuccess', "Hi <b>" . $user->userName . "</b>,<br />Your <b>" . Yii::$app->name . "</b> account has been successfully created.
                                                            You can now activate it from the mail sent to your mail box to start enjoying <b>" . Yii::$app->name . "</b><br />Thanks.");
                    return $this->showIndex();
                }
            }
            /* incase of errors */
            Yii::$app->session->setFlash('signupFail', 'Sorry, a system error occured while creating your account. Try again.');
            /* Delete the already saved data */
            $newUser = User::findOne($user->userId);
            if($newUser != NULL)
                $newUser->delete();  //it ll automatically b deleted from the child tables
        }
        return $this->showIndex();
    }

    /* This action is to activate an account created */
    public function actionActivateAccount($id, $twisup, $ded24twi){
        //logout the user if he/she is logged in
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }

        $user = User::findOne($twisup);
        if($user != NULL){
            $account = ActivateAccount::findOne($twisup);
            $currenturl= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            if(strcmp($currenturl, $account->activateUrl)==0){
                if(!$account->status){  //account not yet activated
                    $account->status = 1;
                    if($account->save()){
                        Yii::$app->user->login($user);
                        if($user->userType == 'A')
                            return Yii::$app->controller->redirect(Url::to(['admin/index'])); 
                        else
                            return Yii::$app->controller->redirect(Url::to(['user/index']));                    }
                    return $this->render('error', [
                        'name' => 'Server Error (#500)',
                        'message' => 'Sorry, a system error occured. Try again.',
                    ]);
                }
                return $this->render('error', [
                    'name' => 'Not Acceptable (#406)',
                    'message' => 'Your account has already been activated: activation link expired.',
                ]);
            }
            return $this->render('error', [
                'name' => 'Forbidden (#403)',
                'message' => 'Sorry, the provided link is wrong. Try again and if it persits, contact Us.',
            ]);
        }
        return $this->render('error', [
            'name' => 'Not Found (#404)',
            'message' => 'Sorry, You are not a registered user on ' . Yii::$app->name .  
                                        '. Go and register.',
        ]);
    }

    /**
     * Displays terms page.
     *
     * @return string
     */
    public function actionTerms()
    {
        return $this->render('terms');
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout(){
        return $this->render('about');
    }

    /**
     * Displays help page.
     *
     * @return string
     */
    public function actionHelp(){
        return $this->render('help');
    }
    
    /**
     * sends a password reset link to a user's email account.
     *
     * @return string
     */
    public function actionSendPasswdResetMail(){
        //logout the user if he/she is logged in
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }

        $passwordResetForm = new PasswordResetForm();
        $passwordResetLinkForm = new PasswordResetLinkForm();
        if ($passwordResetLinkForm->load(Yii::$app->request->post()) && $passwordResetLinkForm->validate()) {
            //search user from user table
            $user = User::findOne(['email' => $passwordResetLinkForm->email]);
            if($user){  //user exist with this email
                /* Creating an activation URL and storing in the DB*/
                $randomString = Yii::$app->getSecurity()->generateRandomString(15);
                $randomString2 = Yii::$app->getSecurity()->generateRandomString(15);
                $passwordResetModel = new PasswordReset();
                $passwordResetModel->resetUrl = date("Y-m-d H:i:s");
                $passwordResetModel->userId = $user->userId;
                if($passwordResetModel->save()){
                    //update resetUrl
                    $addedRec = PasswordReset::findOne(['resetUrl' => $passwordResetModel->resetUrl]);
                    $addedRec->resetUrl = Url::to(['mail-password-reset', 'id' => $randomString,
                                                       'psupa' => $user->userId, 'kol24' => $addedRec->idPasswordReset, 'kunjaka' => $randomString2], 'http');
                    if($addedRec->save()){
                        /* Send the action URL as Mail */
                        Yii::$app->mailer->compose('passwordResetMail', 
                                ['resetUrl' => $addedRec->resetUrl, 'email' => $user->email])
                            ->setFrom(Yii::$app->params['adminEmail'])
                            ->setTo($user->email)
                            ->setSubject(Yii::$app->name . ' password reset link')
                            ->send();
                        //set a flash to this effect
                        Yii::$app->session->setFlash('infoFlash', 
                            'Password reset link successfully sent to your email account. Check the mail for more details.');  
                    }  
                }
            }
            else{   //no such user exist
                //set a flash to this effect
                Yii::$app->session->setFlash('dangerFlash', 'Provided email address not found in our system!');
            }
        }
        return $this->render('passwordReset', [
            'passwordResetForm' => $passwordResetForm,
            'passwordResetLinkForm' => $passwordResetLinkForm,
        ]);
    }

    /**
     * handles clik on password reset link.
     *
     * @return string
     */
    public function actionMailPasswordReset($id, $psupa, $kol24, $kunjaka){
        //logout the user if he/she is logged in
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }

        $mailPasswordResetForm = new MailPasswordResetForm();
        $user = User::findOne($psupa);
        if($user){
            $passwordResetModel = PasswordReset::findOne($kol24);
            $currenturl= 'http://' .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            if(strcmp($currenturl, $passwordResetModel->resetUrl)==0){
                if(!$passwordResetModel->isExpired){  //link not yet expired
                    $passwordResetModel->isExpired = 1;
                    if($passwordResetModel->save()){
                        return $this->render('mailPasswordReset', [
                            'email' => $user->email,
                            'mailPasswordResetForm' => $mailPasswordResetForm,
                        ]);
                    }
                    return $this->render('error', [
                        'name' => 'Server Error (#500)',
                        'message' => 'Sorry, a system error occured. Try again.',
                    ]);
                }
                return $this->render('error', [
                    'name' => 'Not Acceptable (#406)',
                    'message' => 'Password reset link is expired. Request for a new one from the password reset page.',
                ]);
            }
            return $this->render('error', [
                'name' => 'Forbidden (#403)',
                'message' => 'Incorrect password reset link! Try again and if it persits, contact Us.',
            ]);
        }
        return $this->render('error', [
            'name' => 'Not Found (#404)',
            'message' => 'Sorry, You are not a registered user on ' . Yii::$app->name .  
                                        '. Go and register.',
        ]);
    }

    /**
     * resets a user's password.
     *
     * @return string
     */
    public function actionMailPasswordResetFormHandler(){
        //logout the user if he/she is logged in
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }

        $mailPasswordResetForm = new MailPasswordResetForm();
        if ($mailPasswordResetForm->load(Yii::$app->request->post()) && $mailPasswordResetForm->validate()) {
            //search user from user table
            $user = User::findOne(['email' => $mailPasswordResetForm->email]);
            if($user){  //user exist with this email
                /* hash and update password */
                $user->password = Yii::$app->getSecurity()->generatePasswordHash($mailPasswordResetForm->newPass);
                if($user->save()){ //successful password reset
                    //set a flash to this effect
                    Yii::$app->session->setFlash('infoFlash', 
                        'Password reset successful!<br /> You are recommended to view your profile immediately after log in.');
                    return $this->redirect(['index']);
                }
            }
            else{   //no such user exist
                //set a flash to this effect
                Yii::$app->session->setFlash('dangerFlash', 'User Not Found (#404)!!');
            }
        }

        return $this->goBack((!empty(Yii::$app->request->referrer) ? 
                    Yii::$app->request->referrer : null));    
    }

    /**
     * resets a user's password.
     *
     * @return string
     */
    public function actionPasswordReset(){
        //logout the user if he/she is logged in
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }

        $passwordResetForm = new PasswordResetForm();
        $passwordResetLinkForm = new PasswordResetLinkForm();
        if ($passwordResetForm->load(Yii::$app->request->post()) && $passwordResetForm->validate()) {
            //search user from user table
            $user = User::findOne(['email' => $passwordResetForm->email, 'secreteAns' => $passwordResetForm->secreteAns, 'secreteQtn' => $passwordResetForm->secreteQtn]);
            if($user != NULL){  //user exist with this credentials
                /* hash and update password */
                $user->password = Yii::$app->getSecurity()->generatePasswordHash($passwordResetForm->newPass);
                if($user->save()){ //successful password reset
                    //set a flash to this effect
                    Yii::$app->session->setFlash('infoFlash', 'Password reset successful!<br />You can now log in to your account');
                    return $this->redirect(['index']);
                }
            }
            else{   //no such user exist
                //set a flash to this effect
                Yii::$app->session->setFlash('dangerFlash', 
                            "The provided combination of secrete answer and email does'nt exist in our system.");
            }
        }
        return $this->render('passwordReset', [
            'passwordResetForm' => $passwordResetForm,
            'passwordResetLinkForm' => $passwordResetLinkForm,
        ]);
    }

    //show the index view
    protected function showIndex(){
        $loginForm = new LoginForm();
        $signupForm = new SignupForm();
        return $this->render('index', [
            'loginForm' => $loginForm,
            'signupForm' => $signupForm,
        ]);
    }
}
